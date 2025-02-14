<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\VenueAdmin\Database\Factories\VenueBookingDetailsFactory;

class VenueBookingDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'venuebookingdetails';

    // protected static function newFactory(): VenueBookingDetailsFactory
    // {
    //     // return VenueBookingDetailsFactory::new();
    // }


    public function bookingdetails()
    {
        return $this->belongsTo(VenueBooking::class, 'venuebooking_id', 'id');
    }

    public function booking()
    {
        return $this->belongsTo(VenueBooking::class, 'venuebooking_id');
    }
}
