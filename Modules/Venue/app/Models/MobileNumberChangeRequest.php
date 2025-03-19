<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\VenueAdmin\Models\VenueUser;

class MobileNumberChangeRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function venueAdmin(){
        return $this->hasOne(VenueUser::class, 'id', 'venue_admin_id');
    }
}
