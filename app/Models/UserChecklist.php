<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserChecklist extends Model
{
    protected $fillable = ['user_id', 'occasion_id', 'task', 'completed'];
    protected $table = 'user_checklists';

    public static function dashboardStats($eventId)
    {
        $userId = Auth::user()->id;
        return [
            'total_tasks' => self::where('user_id', $userId)->where('occasion_id', $eventId)->count(),
            'completed_tasks' => self::where('user_id', $userId)->where('occasion_id', $eventId)->where('completed_status', 'completed')->count(),
            'pending_tasks' => self::where('user_id', $userId)
                                   ->where('occasion_id', $eventId)
                                   ->where('completed_status', 'doing')
                                   ->count(),
            'not_yet_task' => self::where('user_id', $userId)
                                   ->where('occasion_id', $eventId)
                                   ->where('completed_status', 'not_started')
                                   ->whereColumn('created_at', 'updated_at')
                                   ->count(),
        ];
    }
}
