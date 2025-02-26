<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    protected $table = 'userimage';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'thumb_url',
        'image_url'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
