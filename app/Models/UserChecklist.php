<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserChecklist extends Model
{
    protected $fillable = ['user_id', 'useroccasion_id', 'task', 'completed'];
    protected $table = 'user_checklists';

    public static function dashboardStats($eventId)
    {
        $userId = Auth::user()->id;
        return [
            'total_tasks' => self::where('user_id', $userId)->where('useroccasion_id', $eventId)->where('delete_status','0')->count(),
            'completed_tasks' => self::where('user_id', $userId)->where('useroccasion_id', $eventId)->where('delete_status','0')->where('completed_status', 'completed')->count(),
            'pending_tasks' => self::where('user_id', $userId)
                                   ->where('useroccasion_id', $eventId)
                                   ->where('delete_status','0')
                                   ->where('completed_status', 'doing')
                                   ->count(),
            'not_yet_task' => self::where('user_id', $userId)
                                   ->where('useroccasion_id', $eventId)
                                   ->where('completed_status', 'not_started')
                                   ->where('delete_status','0')
                                   ->whereColumn('created_at', 'updated_at')
                                   ->count(),
        ];
    }
}
