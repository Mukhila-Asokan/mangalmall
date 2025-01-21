<?php

namespace Modules\StaffManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\StaffManagement\Database\Factories\StaffFactory;

class Staff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = "staff";

    // protected static function newFactory(): StaffFactory
    // {
    //     // return StaffFactory::new();
    // }
}
