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
}
