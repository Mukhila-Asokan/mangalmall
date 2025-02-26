<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueDetailsFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VenueDetails extends Model
{
    use HasFactory;

    protected $table = 'venuedetails';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): VenueDetailsFactory
    // {
    //     // return VenueDetailsFactory::new();
    // }

    public function venuettype()
    {
        return $this->hasOne(VenueType::class,'id','venuetypeid');
    }
    public function venuetsubtype()
    {
        return $this->hasOne(VenueType::class,'id','venuesubtypeid');
    }
    public function indianlocation()
    {
        return $this->hasOne(indialocation::class,'id','locationid');
    }
    public function venueamenities()
    {
         return $this->belongsToMany(VenueAmenities::class, 'venueamenities', 'venue_id', 'id');
    }
    public function venueamenitiesapi()
    {
        return $this->hasMany(VenueAmenities::class, 'venue_id', 'id'); 
    }
    public function venueimage()
    {
        return $this->hasMany(VenueImage::class, 'venue_id', 'id');
    }
    public function venuecontent()
    {
        return $this->hasMany(VenueContent::class, 'venue_id', 'id');
    }
    public function area()
    {
        return $this->hasOne(Area::class,'id','locationid');
    }
    public function city()
    {
        return $this->hasOneThrough(
            City::class,
            Area::class,
            'id', // Foreign key on the areas table...
            'id', // Foreign key on the cities table...
            'areaid', // Local key on the venues table...
            'cityid' // Local key on the areas table...
        );
    }
    public function state()
    {
        return $this->hasOneThrough(
            State::class,
            District::class,
            'id', // Foreign key on the districts table...
            'id', // Foreign key on the states table...
            'districtid', // Local key on the venues table...
            'stateid' // Local key on the districts table...
        );
    }

    public function district()
    {
        return $this->hasOneThrough(
            District::class,
            Area::class,
            'id', // Foreign key on the areas table...
            'id', // Foreign key on the districts table...
            'areaid', // Local key on the venues table...
            'districtid' // Local key on the areas table...
        );
    }
   

}
