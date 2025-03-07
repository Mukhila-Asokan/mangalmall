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



    public function contact()
    {
        return $this->hasOne(VenueBookingContact::class, 'venuebooking_id');
    }

    public function details()
    {
        return $this->hasMany(VenueBookingDetails::class, 'venuebooking_id');
    }
    public function venue()
    {
        return $this->hasOne('Modules\Venue\Models\VenueDetails', 'venue_id');
    }
    public function user()
    {
        return $this->belongsTo('Modules\VenueAdmin\Models\VenueUser', 'user_id');
    }

    public function venuepricing()
    {
        return $this->hasOne('Modules\VenueAdmin\Models\VenuePricing', 'venue_id');
    }

}
