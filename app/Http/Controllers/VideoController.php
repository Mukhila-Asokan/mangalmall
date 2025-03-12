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

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('user_id', Auth::user()->id)->get();
        return view('videos.index', compact('videos'));
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
                $path = $image->storeAs('public/uploads/images', $filename);
                
                $media = UserMedia::create([
                    'filename' => $filename,
                    'path' => Storage::url($path),
                    'type' => 'image',
                    'user_id' =>  Auth::user()->id,
                ]);

                $uploadedImages[] = [
                    'id' => $media->id,
                    'image_url' => $media->path,
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
            $path = $audio->storeAs('public/uploads/audio', $filename);
            
            $media = UserMedia::create([
                'filename' => $filename,
                'path' => Storage::url($path),
                'type' => 'audio',
                'user_id' =>  Auth::user()->id,
            ]);

            return response()->json([
                'success' => true,
                'audio_id' => $media->id,
                'audio_url' => $media->path,
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => 'No audio file uploaded',
        ]);
    }

    public function createVideo(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:usermedia,id',
            'images.*.duration' => 'required|integer|min:1',
            'audio_id' => 'required|exists:usermedia,id',
        ]);

        // Get the audio file
        $audio = UserMedia::findOrFail($request->audio_id);
        $audioPath = storage_path('app/public/' . str_replace('/storage/', '', $audio->path));

        // Get all images
        $imageData = $request->images;
        $imageFiles = [];
        
        foreach ($imageData as $data) {
            $image = UserMedia::findOrFail($data['id']);
            $imageFiles[] = [
                'path' => storage_path('app/public/' . str_replace('/storage/', '', $image->path)),
                'duration' => $data['duration'],
            ];
        }

        // Create a temporary directory for the slideshow frames
        $tempDir = storage_path('app/public/temp/' . Str::random(10));
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Initialize FFMpeg
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg', // adjust this path as needed
            'ffprobe.binaries' => '/usr/bin/ffprobe', // adjust this path as needed
        ]);

        // Create individual video clips for each image
        $videoClips = [];
        $position = 0;
        
        foreach ($imageFiles as $index => $imageFile) {
            $outputPath = "{$tempDir}/segment_{$index}.mp4";
            
            // Create video from image with specified duration
            $ffmpeg->open($imageFile['path'])
                ->frame(TimeCode::fromSeconds(0))
                ->save("{$tempDir}/frame_{$index}.jpg");
                
            exec("ffmpeg -loop 1 -i {$tempDir}/frame_{$index}.jpg -c:v libx264 -t {$imageFile['duration']} -pix_fmt yuv420p {$outputPath}");
            
            $videoClips[] = $outputPath;
            $position += $imageFile['duration'];
        }

        // Create a file list for concatenation
        $listFile = "{$tempDir}/list.txt";
        $listContent = '';
        
        foreach ($videoClips as $clip) {
            $listContent .= "file '" . $clip . "'\n";
        }
        
        file_put_contents($listFile, $listContent);

        // Concatenate video clips
        $concatOutput = "{$tempDir}/concat.mp4";
        exec("ffmpeg -f concat -safe 0 -i {$listFile} -c copy {$concatOutput}");

        // Add audio to the video
        $finalOutput = "public/uploads/videos/" . time() . '_' . Str::random(10) . '.mp4';
        $finalOutputPath = storage_path('app/' . $finalOutput);
        
        exec("ffmpeg -i {$concatOutput} -i {$audioPath} -map 0:v -map 1:a -c:v copy -shortest {$finalOutputPath}");

        // Save the video to the database
        $video = UserMedia::create([
            'filename' => basename($finalOutputPath),
            'path' => Storage::url($finalOutput),
            'type' => 'video',
            'user_id' => Auth::user()->id,
        ]);

        // Clean up temporary files
        array_map('unlink', glob("{$tempDir}/*"));
        rmdir($tempDir);

        return response()->json([
            'success' => true,
            'video_id' => $video->id,
            'video_url' => $video->path,
        ]);
    }
}
