<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videoimage extends Model
{
    protected $table = 'videoimages';
    protected $fillable = ['user_id', 'path', 'status', 'delete_status'];
}
