<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\VenueAdmin\Models\VenuePricingAddon;
use Illuminate\Pagination\Paginator;

// use Modules\VenueAdmin\Database\Factories\VenuePricingFactory;

class VenuePricing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'venuepricing';
    // protected static function newFactory(): VenuePricingFactory
    // {
    //     // return VenuePricingFactory::new();
    // }

    public function venue()
    {
        return $this->belongsTo('Modules\Venue\Models\VenueDetails', 'venue_id');
    }
  
    public function addons()
    {
        return $this->hasMany(VenuePricingAddon::class, 'venuepricingid', 'id'); 
    }
}
