<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\VenueAdmin\Database\Factories\VenuePriceAddonsFactory;

class VenuePriceAddons extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'venuepriceaddons';

    // protected static function newFactory(): VenuePriceAddonsFactory
    // {
    //     // return VenuePriceAddonsFactory::new();
    // }

    public function addons()
    {
        return $this->belongsTo(VenuePricingAddon::class, 'addonid', 'id'); 
    }
    public function venuebookingaddons()
    {
        return $this->hasMany(VenuePricingAddon::class, 'venue_pricing_addon_id', 'id');
    }
}
