<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaudio extends Model
{
    protected $table = 'vaudios';
    protected $fillable = ['user_id', 'path', 'uploaded_by', 'status', 'delete_status'];
}
