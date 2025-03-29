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
use Symfony\Component\Process\Exception\ProcessTimedOutException;
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
    $request->validate([
        'images' => 'required|array|min:1|max:20',
        'images.*' => 'required|image|mimes:jpeg,png|max:10240|dimensions:min_width=640,min_height=480',
        'audio' => 'nullable|file|mimes:mp3,wav,ogg,aac|max:20480',
        'durations' => 'required|array|size:'.count($request->file('images')),
        'texts' => 'nullable|array',
        'texts.*.text' => 'nullable|string|max:100',
        'texts.*.color' => 'nullable|string',
        'texts.*.fontSize' => 'nullable|integer|min:10|max:50',
        'texts.*.position' => 'nullable|in:top,center,bottom',
        'texts.*.duration' => 'nullable|numeric|min:1|max:10',
        'effect' => 'nullable|in:fade,zoom,slide,none'
    ]);

    $processId = Str::uuid();
    
    // Normalize paths for Windows
    $tempPath = str_replace('/', '\\', public_path('video-temp' . DIRECTORY_SEPARATOR . $processId));
    $outputPath = str_replace('/', '\\', public_path('storage' . DIRECTORY_SEPARATOR . 'videos'));

    try {
        // Create directories with proper error handling
        if (!file_exists($tempPath) && !mkdir($tempPath, 0755, true)) {
            throw new \Exception("Failed to create temporary directory: {$tempPath}");
        }

        if (!file_exists($outputPath) && !mkdir($outputPath, 0755, true)) {
            throw new \Exception("Failed to create output directory: {$outputPath}");
        }

        // Verify directory is writable
        if (!is_writable($tempPath)) {
            throw new \Exception("Temporary directory is not writable: {$tempPath}");
        }

        $imageFiles = [];
        $imageCount = 0;
        foreach ($request->file('images') as $key => $imageFile) {
            $fileName = "{$imageCount}.jpg";
            $imagePath = $tempPath . DIRECTORY_SEPARATOR . $fileName;
            
            // Convert image to JPG if it's PNG
            if (strtolower($imageFile->getClientOriginalExtension()) === 'png') {
                $image = imagecreatefrompng($imageFile->getPathname());
                imagejpeg($image, $imagePath, 90);
                imagedestroy($image);
            } else {
                $imageFile->move($tempPath, $fileName);
            }

            $textOverlays = $request->input('texts', []);
            if (!empty($textOverlays)) {
                foreach ($textOverlays as $textData) {
                    $this->addTextToImage($imagePath, $textData);
                }
            }

            $imageFiles[] = $imagePath;
            $imageCount++;
        }

        $audioPath = null;
        if ($request->hasFile('audio')) {
            $audioExt = $request->file('audio')->getClientOriginalExtension();
            $audioFileName = "audio.{$audioExt}";
            $request->file('audio')->move($tempPath, $audioFileName);
            $audioPath = $tempPath . DIRECTORY_SEPARATOR . $audioFileName;
        }

        $fileListPath = $tempPath . DIRECTORY_SEPARATOR . 'filelist.txt';
        $fileContents = '';
        $durations = $request->input('durations', []);
        $effect = $request->input('effect', 'fade');

        foreach ($imageFiles as $index => $img) {
            $normalizedImgPath = str_replace('\\', '/', $img); // FFmpeg needs forward slashes
            $fileContents .= "file '{$normalizedImgPath}'\n";
            $duration = $durations[$index] ?? 2;
            $fileContents .= "duration " . number_format((float)$duration, 1, '.', '') . "\n";
        }
        
        if (count($imageFiles) > 0) {
            $normalizedLastImg = str_replace('\\', '/', $imageFiles[count($imageFiles) - 1]);
            $fileContents .= "file '{$normalizedLastImg}'\n";
            $fileContents .= "duration 2.5\n";
        }

        $bytesWritten = file_put_contents($fileListPath, $fileContents);
        if ($bytesWritten === false) {
            throw new \Exception("Failed to write to filelist.txt");
        }

        $videoFileName = "video_{$processId}.mp4";
        $outputVideoPath = $outputPath . DIRECTORY_SEPARATOR . $videoFileName;

        $ffmpegCmd = [
            'ffmpeg',
            '-y',
            '-f', 'concat',
            '-safe', '0',
            '-i', $fileListPath,
        ];

        if ($audioPath) {
            $normalizedAudioPath = str_replace('\\', '/', $audioPath);
            $ffmpegCmd = array_merge($ffmpegCmd, [
                '-i', $normalizedAudioPath,
                '-c:v', 'libx264',
                '-preset', 'slow',
                '-crf', '22',
                '-c:a', 'aac',
                '-b:a', '192k',
                '-pix_fmt', 'yuv420p',
                '-shortest',
                '-movflags', '+faststart'
            ]);
        } else {
            $ffmpegCmd = array_merge($ffmpegCmd, [
                '-c:v', 'libx264',
                '-preset', 'slow',
                '-crf', '22',
                '-pix_fmt', 'yuv420p',
                '-movflags', '+faststart'
            ]);
        }

        switch ($effect) {
            case 'fade':
                $ffmpegCmd[] = '-vf';
                $ffmpegCmd[] = 'fade=type=in:duration=1,fade=type=out:duration=1';
                break;
            case 'zoom':
                $ffmpegCmd[] = '-vf';
                $ffmpegCmd[] = "zoompan=z='min(zoom+0.03,1.5)':d=1:x='iw/2':y='ih/2'";
                break;
            case 'slide':
                // Alternative slide implementation
                try {
                    $ffmpegCmd[] = '-vf';
                    $ffmpegCmd[] = 'slide=out_w=1280:out_h=720:duration=1';
                } catch (\Exception $e) {
                    // Fallback to fade if slide not available
                    Log::warning('Slide filter not available, using fade instead');
                    $ffmpegCmd[] = '-vf';
                    $ffmpegCmd[] = 'fade=type=in:duration=1,fade=type=out:duration=1';
                }
                break;
            default:
                // No effect
                break;
        }

        $ffmpegCmd[] = str_replace('\\', '/', $outputVideoPath);

        try {
            $process = new Process($ffmpegCmd);
            $process->setTimeout(600);
            $process->run();
            
            if (!$process->isSuccessful()) {
                $errorOutput = $process->getErrorOutput();
                if (strpos($errorOutput, 'No such filter') !== false) {
                    throw new \Exception("The requested video effect is not available in your FFmpeg installation");
                }
                throw new ProcessFailedException($process);
            }
        } catch (\Exception $e) {
            Log::error('Process Error: '.$e->getMessage());
            throw new ProcessFailedException($process);
        }
        // Create thumbnail
        $thumbnailPath = $outputPath . DIRECTORY_SEPARATOR . "thumb_{$processId}.jpg";
        $thumbnailCmd = [
            'ffmpeg',
            '-y',
            '-ss', '00:00:01',
            '-i', str_replace('\\', '/', $outputVideoPath),
            '-vframes', '1',
            '-q:v', '2',
            str_replace('\\', '/', $thumbnailPath)
        ];
        
        $thumbnailProcess = new Process($thumbnailCmd);
        $thumbnailProcess->run();

        // Cleanup
        array_map('unlink', glob($tempPath . DIRECTORY_SEPARATOR . '*'));
        rmdir($tempPath);

        return response()->json([
            'success' => true,
            'videoUrl' => asset("storage/videos/" . rawurlencode($videoFileName)),
            'thumbnail' => asset("storage/videos/" . rawurlencode("thumb_{$processId}.jpg")),
            'message' => 'Video created successfully',
        ]);

    } catch (\Exception $e) {
        // Cleanup on failure
        if (file_exists($tempPath)) {
            array_map('unlink', glob($tempPath . DIRECTORY_SEPARATOR . '*'));
            @rmdir($tempPath);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create video: ' . $e->getMessage(),
            'error_details' => $e instanceof ProcessFailedException ? $e->getProcess()->getErrorOutput() : null,
        ], 500);
    }
}

private function addTextToImage($imagePath, $textData)
{
    try {
        $text = $textData['text'] ?? '';
        if (empty($text)) return;

        $imageInfo = getimagesize($imagePath);
        $extension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        
        // Support both JPG and PNG
        if ($extension === 'png') {
            $image = imagecreatefrompng($imagePath);
        } else {
            $image = imagecreatefromjpeg($imagePath);
        }
        
        // Add background to text for better readability
        $this->addTextBackground($image, $textData, $imageInfo[0], $imageInfo[1]);
        
        // Rest of your text overlay code...
    } catch (\Exception $e) {
        Log::error('Text overlay error: '.$e->getMessage());
    }
}
private function addTextBackground($image, $textData, $imageWidth, $imageHeight)
{
    $text = $textData['text'];
    $fontSize = $textData['fontSize'] ?? 24;
    $position = $textData['position'] ?? 'center';
    
    $bbox = imagettfbbox($fontSize, 0, public_path('fonts/arial.ttf'), $text);
    $textWidth = abs($bbox[4] - $bbox[0]);
    $textHeight = abs($bbox[1] - $bbox[5]);
    
    $padding = 10;
    $bgWidth = $textWidth + ($padding * 2);
    $bgHeight = $textHeight + ($padding * 2);
    
    $x = ($imageWidth - $bgWidth) / 2;
    $y = match($position) {
        'top' => $textHeight + $padding + 20,
        'bottom' => $imageHeight - $textHeight - $padding - 20,
        default => ($imageHeight - $bgHeight) / 2,
    };
    
    $bgColor = imagecolorallocatealpha($image, 0, 0, 0, 60); // Semi-transparent black
    imagefilledrectangle($image, $x, $y, $x + $bgWidth, $y + $bgHeight, $bgColor);
}

private function hexToRGB($hex)
{
    $hex = str_replace('#', '', $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }

    return ['r' => $r, 'g' => $g, 'b' => $b];
}

private function calculateTextBox($text, $fontSize, $imageWidth, $imageHeight, $position)
{
    $bbox = imagettfbbox($fontSize, 0, public_path('fonts/arial.ttf'), $text);
    $textWidth = abs($bbox[4] - $bbox[0]);
    $textHeight = abs($bbox[1] - $bbox[5]);
    $x = ($imageWidth - $textWidth) / 2;

    $y = match($position) {
        'top' => $textHeight + 20,
        'bottom' => $imageHeight - 20,
        default => $imageHeight / 2,
    };

    return [
        'x' => max(0, $x),
        'y' => $y
    ];
}
public function deleteVideo(Request $request)
{
    $request->validate([
        'video_id' => 'required|integer|exists:videos,id',
    ]); 
    $video = Video::find($request->video_id);
    if ($video) {
        $video->delete();
        return response()->json([
            'success' => true,
            'message' => 'Video deleted successfully',
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Video not found',
        ], 404);
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
