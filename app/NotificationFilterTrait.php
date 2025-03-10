<?php

namespace App;

use Carbon\Carbon;

trait NotificationFilterTrait
{
    public function filterNotificationsByDate($notifications)
    {
        $today = now();
        $yesterday = now()->subDay();

        return [
            'today' => $notifications->filter(fn($n) => Carbon::parse($n->created_at)->isToday()),
            'yesterday' => $notifications->filter(fn($n) => Carbon::parse($n->created_at)->isYesterday()),
            'older' => $notifications->filter(fn($n) => Carbon::parse($n->created_at)->lt($yesterday)),
        ];
    }
}
