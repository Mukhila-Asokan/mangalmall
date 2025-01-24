<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\VenueAdmin\Database\Factories\VenueBookingContactFactory;

class VenueBookingContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "venuebookingpersondetails";

    // protected static function newFactory(): VenueBookingContactFactory
    // {
    //     // return VenueBookingContactFactory::new();
    // }
}
