<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanOldVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-old-videos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directory = public_path('storage/videos');
        $files = glob("{$directory}/*.{mp4,jpg}", GLOB_BRACE);
    
        $now = time();
        $expiration = 60 * 60; // 1 hour
    
        foreach ($files as $file) {
            if (is_file($file) && ($now - filemtime($file)) > $expiration) {
                unlink($file);
            }
        }
    
        $this->info('Old videos and thumbnails cleaned up.');
    }
}
