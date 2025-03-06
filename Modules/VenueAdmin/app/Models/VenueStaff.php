<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VenueStaff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'venue_staffs';
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    // protected static function newFactory(): VenueStaffFactory
    // {
    //     // return VenueStaffFactory::new();
    // }
}
