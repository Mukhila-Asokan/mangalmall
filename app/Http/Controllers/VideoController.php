<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videoimage;
use App\Models\Vaudio;
use App\Models\Video;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFProbe;
use FFMpeg\Media\Video as FFMpegVideo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\UserMedia;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Intervention\Image\Facades\Image;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('user_id', Auth::user()->id)->get();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        $videos = Video::where('user_id', Auth::user()->id)->get();
        return view('videos.create',compact('videos'));
    }

   /* public function uploadImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);

                $uploadedImages[] = [
                    'image_url' => asset('uploads/' . $imageName)
                ];

                $image = new Videoimage();  
                $image->user_id = Auth::user()->id;
                $image->path = $imageName;
                $image->status = 'Active';
                $image->delete_status = 0;
                $image->save();
            }

            return response()->json([
                'success' => 'Images uploaded successfully.',
                'images' => $uploadedImages
            ]);
        }

        return response()->json(['error' => 'Image upload failed.']);
    }*/

    public function uploadImagesView()
    {
        return view('media.upload');
    }

    public function uploadImages(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $uploadedImages = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                
                // Save file in the correct path
                $path = $image->storeAs('videomakingimages', $filename, 'public_uploads');
    
                // Save the **absolute path** for FFmpeg usage
                $absolutePath = public_path("storage/{$path}");
    
                $media = UserMedia::create([
                    'filename' => $filename,
                    'path' => $absolutePath,  // Absolute path for FFmpeg
                    'type' => 'image',
                    'user_id' => Auth::user()->id,
                ]);
    
                $uploadedImages[] = [
                    'id' => $media->id,
                    'image_url' => asset('storage/videomakingimages/' . $filename),
                ];
            }
        }
    
        return response()->json([
            'success' => true,
            'images' => $uploadedImages,
        ]);
    }
    

    public function uploadAudio(Request $request)
{
    $request->validate([
        'audio' => 'required|mimes:mp3,wav,ogg|max:10240',
    ]);

    if ($request->hasFile('audio')) {
        $audio = $request->file('audio');
        $filename = time() . '_' . Str::random(10) . '.' . $audio->getClientOriginalExtension();
        $path = $audio->storeAs('videomakingaudio', $filename, 'public_uploads');

        // Save the **absolute path** for FFmpeg usage
        $absolutePath = public_path("storage/{$path}");

        $media = UserMedia::create([
            'filename' => $filename,
            'path' => $absolutePath,
            'type' => 'audio',
            'user_id' =>  Auth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'audio_id' => $media->id,
            'audio_url' => asset('storage/videomakingaudio/' . $filename),
        ]);
    }

    return response()->json([
        'success' => false,
        'error' => 'No audio file uploaded',
    ]);
}


    
    public function usercreateVideo(Request $request)
    {
         // Validate request
         $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|image|max:10240', // 10MB max per image
            'audio' => 'nullable|file|mimes:mp3,wav,ogg|max:20480', // 20MB max for audio
            'duration' => 'required|integer|min:1|max:10', // Seconds per image
        ]);

        // Create unique folder for this process
        $processId = Str::uuid();
        $tempPath = "temp/{$processId}";
        $outputPath = "public/videos";
        
        Storage::makeDirectory($tempPath);
        Storage::makeDirectory($outputPath);
        
        try {
            // Save images to disk
            $imageFiles = [];
            $imageCount = 0;
            
            foreach ($request->file('images') as $imageFile) {
                $fileName = "{$imageCount}.jpg";
                $path = $imageFile->storeAs($tempPath, $fileName);
                $imageFiles[] = Storage::path($path);
                $imageCount++;
            }
            
            // Save audio file if provided
            $audioPath = null;
            if ($request->hasFile('audio')) {
                $audioFile = $request->file('audio');
                $audioPath = $audioFile->storeAs($tempPath, 'audio.' . $audioFile->getClientOriginalExtension());
                $audioPath = Storage::path($audioPath);
            }
            
            // Create a text file with file paths for ffmpeg
            $fileListPath = Storage::path("{$tempPath}/filelist.txt");
            $fileContents = '';
            
            $duration = $request->input('duration', '2.0'); // Default 2 seconds per image
            
            foreach ($imageFiles as $img) {
                $fileContents .= "file '{$img}'\n";
                $fileContents .= "duration {$duration}\n";
            }
            
            // Add the last image with a very small duration to avoid issues with certain players
            if (count($imageFiles) > 0) {
                $fileContents .= "file '{$imageFiles[count($imageFiles) - 1]}'\n";
                $fileContents .= "duration 2.5\n";
            }
            
            file_put_contents($fileListPath, $fileContents);
            
            // Output video name
            $videoFileName = "video_{$processId}.mp4";
            $outputVideoPath = Storage::path("{$outputPath}/{$videoFileName}");
            
            // Command for creating video from images
            $ffmpegCommand = [
                'ffmpeg',
                '-y',  // Overwrite output files
                '-f', 'concat',
                '-safe', '0',
                '-i', $fileListPath,
                '-vsync', 'vfr',
                '-pix_fmt', 'yuv420p'
            ];
            
            // Add audio if provided
            if ($audioPath) {
                $ffmpegCommand = array_merge($ffmpegCommand, [
                    '-i', $audioPath,
                    '-c:v', 'libx264',
                    '-c:a', 'aac',
                    '-shortest'  // End when the shortest input stream ends
                ]);
            } else {
                $ffmpegCommand = array_merge($ffmpegCommand, [
                    '-c:v', 'libx264',
                ]);
            }
            
            // Complete the command with output file
            $ffmpegCommand[] = $outputVideoPath;
            
            // Execute ffmpeg command
            $process = new Process($ffmpegCommand);
            $process->setTimeout(300); // 5 minutes timeout
            $process->run();
            
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            
            // Clean up temporary files
            Storage::deleteDirectory($tempPath);
            
            // Return success response with video URL
            return response()->json([
                'success' => true,
                'videoUrl' => asset("storage/videos/{$videoFileName}"),
                'message' => 'Video created successfully',
            ]);
            
        } catch (\Exception $e) {
            // Clean up temporary files on error
            Storage::deleteDirectory($tempPath);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create video: ' . $e->getMessage(),
            ], 500);
        }
    }
    


    public function createVideo_old(Request $request)
{
    // Validate request
    $request->validate([
        'images' => 'required|array',
        'images.*' => 'required|image|max:10240',
        'audio' => 'nullable|file|mimes:mp3,wav,ogg|max:20480',
        'duration' => 'required|integer|min:1|max:10',
    ]);

    // Create unique folder for this process
    $processId = Str::uuid();
    $tempPath = "temp/{$processId}";
    $outputPath = "public/videos";

    Storage::makeDirectory($tempPath);
    Storage::makeDirectory($outputPath);

    try {
        // Save images to disk
        $imageFiles = [];
        $imageCount = 0;

       /* foreach ($request->file('images') as $imageFile) {
            $fileName = "{$imageCount}.jpg";
            $path = $imageFile->storeAs($tempPath, $fileName);
            $imageFiles[] = Storage::path($path);
            $imageCount++;
        }*/

        foreach ($request->images as $image) {
            $imageMedia = UserMedia::find($image['id']);
            $imagePath = str_replace('/storage/', '', $imageMedia->file_path);

            // Correct path reference
            if (Storage::exists($imagePath)) {
                $imageFiles[] = Storage::path($imagePath);
            } elseif (file_exists(public_path($imageMedia->file_path))) {
                $imageFiles[] = public_path($imageMedia->file_path);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Image file with ID {$image['id']} not found."
                ], 400);
            }
        }




     /*   // Save audio file if provided
        $audioPath = null;
        if ($request->hasFile('audio')) {
            $audioFile = $request->file('audio');
            $audioPath = $audioFile->storeAs($tempPath, 'audio.' . $audioFile->getClientOriginalExtension());
            $audioPath = Storage::path($audioPath);
        }*/





         // Correcting Audio Path
         $audioMedia = UserMedia::find($request->audio_id);
         $audioPath = str_replace('/storage/', '', $audioMedia->file_path);
 
         if (Storage::exists($audioPath)) {
             $audioPath = Storage::path($audioPath);
         } elseif (file_exists(public_path($audioMedia->file_path))) {
             $audioPath = public_path($audioMedia->file_path);
         } else {
             return response()->json([
                 'success' => false,
                 'message' => "Audio file with ID {$request->audio_id} not found."
             ], 400);
         }
 

        // Create a text file with file paths for ffmpeg
        $fileListPath = Storage::path("{$tempPath}/filelist.txt");
        $fileContents = '';

        foreach ($request->images as $image) {
            $imagePath = UserMedia::find($image['id'])->file_path;
            $imagePath = str_replace('/storage/', '', $imagePath);
            $fileContents .= "file '{$imagePath}'\n";
            $fileContents .= "duration {$image['duration']}\n";
        }

        file_put_contents($fileListPath, $fileContents);

        // Output video name
        $videoFileName = "video_{$processId}.mp4";
        $outputVideoPath = Storage::path("{$outputPath}/{$videoFileName}");

        $ffmpegCommand = [
            'ffmpeg',
            '-y',
            '-f', 'concat',
            '-safe', '0',
            '-i', $fileListPath,
            '-i', $audioPath,
            '-c:v', 'libx264',
            '-c:a', 'aac',
            '-shortest',
            $outputVideoPath
        ];

        $process = new Process($ffmpegCommand);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json([
            'success' => true,
            'video_url' => asset("storage/videos/{$videoFileName}"),
            'message' => 'Video created successfully',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create video: ' . $e->getMessage(),
        ], 500);
    }
}

public function createVideo(Request $request)
{
    $request->validate([
        'images' => 'required|array',
        'images.*.id' => 'required|integer|exists:usermedia,id', 
        'images.*.duration' => 'required|integer|min:1|max:10',
        'audio_id' => 'required|integer|exists:usermedia,id',
    ]);

    try {
        $processId = Str::uuid();
        $tempPath = "temp/{$processId}";
        $outputPath = "public/videos";

        Storage::makeDirectory($tempPath);
        Storage::makeDirectory($outputPath);

        // Correct Image Paths
        $imageFiles = [];
        foreach ($request->images as $image) {
            $imageMedia = UserMedia::find($image['id']);
            $imageFiles[] = $imageMedia->path;
        }

        // Correct Audio Path
        $audioMedia = UserMedia::find($request->audio_id);
        /*$audioPath = $audioMedia->path;*/

        /*$audioPath = str_replace('\\', '/', public_path($audioMedia->path));*/

        $audioPath = str_replace('\\', '/', $audioMedia->path); 
       
       
        $fileListPath = Storage::path("{$tempPath}/filelist.txt");
        $fileContents = '';
        
        foreach ($request->images as $image) {
            $imageMedia = UserMedia::find($image['id']);
            $imagePath = str_replace('\\', '/', $imageMedia->path);  // Only convert slashes
            $fileContents .= "file '{$imagePath}'\n";
            $fileContents .= "duration {$image['duration']}.0\n";
        }
        
        // Correct Final Image Addition
        if (!empty($imagePath)) {
            $fileContents .= "file '{$imagePath}'\n";
            $fileContents .= "duration 0.1\n";
        }
        
        file_put_contents($fileListPath, $fileContents);
        

        // FFMpeg Command
        $videoFileName = "video_{$processId}.mp4";
        $outputVideoPath = Storage::path("{$outputPath}/{$videoFileName}");
        

        $ffmpegCommand = [
            'ffmpeg',
            '-y',
            '-f', 'concat',
            '-safe', '0',
            '-i', $fileListPath,
            '-vf', 'scale=1280:720',
            '-r', '25',
            '-i', $audioPath,
            '-map', '0:v:0',
            '-map', '1:a:0',
            '-c:v', 'libx264',
            '-pix_fmt', 'yuv420p',
            '-c:a', 'aac',
            '-shortest',
            $outputVideoPath
        ];
        

        $process = new Process($ffmpegCommand);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json([
            'success' => true,
            'video_url' => asset("storage/videos/{$videoFileName}"),
            'message' => 'Video created successfully',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create video: ' . $e->getMessage(),
        ], 500);
    }
}





}
