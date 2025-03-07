<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\VenueAdmin\Database\Factories\VenuePricingAddonFactory;

class VenuePricingAddon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'venuepricingaddon';

    // protected static function newFactory(): VenuePricingAddonFactory
    // {
    //     // return VenuePricingAddonFactory::new();
    // }

    public function addon()
    {
        return $this->belongsTo(VenuePriceAddons::class, 'addonid', 'id'); 
    }

  


}
