<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueTypeFactory;

class VenueType extends Model
{
    use HasFactory;

     protected $table = 'venuetype';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): VenueTypeFactory
    // {
    //     // return VenueTypeFactory::new();
    // }

    public function venueDetails()
    {
        return $this->belongsTo(VenueDetails::class, 'venuetypeid', 'id');
    }

}
