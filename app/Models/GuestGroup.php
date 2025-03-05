<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestGroup extends Model
{
    use SoftDeletes;
    
    protected $table = 'guest_groups';
    
    protected $guarded = [];
}
