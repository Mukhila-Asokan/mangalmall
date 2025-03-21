<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Venue\Models\VenueDetails;

class BookingEnquiry extends Model
{
    protected $table = 'booking_enquiries';

    protected $guarded = [];

    public function venue(){
        return $this->hasOne(VenueDetails::class, 'id', 'venue_id');
    }
}
