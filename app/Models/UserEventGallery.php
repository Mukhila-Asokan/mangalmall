<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEventGallery extends Model
{
    use SoftDeletes;

    protected $table = 'user_event_gallery';

    protected $guarded = [];
}
