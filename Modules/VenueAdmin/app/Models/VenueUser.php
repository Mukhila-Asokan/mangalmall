<?php

namespace Modules\VenueAdmin\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Venue\Models\VenueDetails;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Modules\VenueAdmin\Database\Factories\VenueUserFactory;

class VenueUser extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name','mobileno'];

    protected $table = 'venueuser';

    // protected static function newFactory(): VenueUserFactory
    // {
    //     // return VenueUserFactory::new();
    // }

    public function venue()
    {
        return $this->belongsTo(VenueDetails::class, 'venueid', 'id');
    }

}
