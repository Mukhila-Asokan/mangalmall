<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\VenueAdmin\Database\Factories\VenueBookingFactory;

class VenueBooking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'venuebooking';

    // protected static function newFactory(): VenueBookingFactory
    // {
    //     // return VenueBookingFactory::new();
    // }
}
