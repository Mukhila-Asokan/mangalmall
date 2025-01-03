<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueAmenitiesFactory;

class VenueAmenities extends Model
{
    use HasFactory;

    protected $table = 'venueamenities';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): VenueAmenitiesFactory
    // {
    //     // return VenueAmenitiesFactory::new();
    // }
}
