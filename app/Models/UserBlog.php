<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBlog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title','blogs','category','tags','status'];
   
}
