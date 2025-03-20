<?php

namespace Modules\VenueAdmin\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Venue\Models\VenueDetails;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Venue\Models\MobileNumberChangeRequest;

class VenueUser extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','mobileno'];

    protected $table = 'venueuser';

    public function venue()
    {
        return $this->belongsTo(VenueDetails::class, 'venueid', 'id');
    }

    public function request()
    {
        return $this->belongsTo(MobileNumberChangeRequest::class, 'venue_admin_id', 'id');
    }

}
