<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserImageLibrary extends Model
{
    protected $table = 'userimagelibrary';
    protected $fillable = ['userid','image_name','image_path','source'];
}
