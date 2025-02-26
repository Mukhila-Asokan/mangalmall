<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubUser extends Model
{
    protected $table = 'sub_users';
    protected $fillable = [
        'parent_user_id',
        'sub_user_id',
        'sub_user_type',
        'status',
 
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'sub_user_id', 'id');
    }
    public function subUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
