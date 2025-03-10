<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;   // Import Str to define the macro
use Carbon\Carbon;    

class NotificationMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       
        Str::macro('filterNotificationsByDate', function ($notifications) {
            $today = now();
            $yesterday = now()->subDay();

            return [
                'today' => $notifications->filter(fn($n) => Carbon::parse($n->created_at)->isToday()),
                'yesterday' => $notifications->filter(fn($n) => Carbon::parse($n->created_at)->isYesterday()),
                'older' => $notifications->filter(fn($n) => Carbon::parse($n->created_at)->lt($yesterday)),
            ];
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
