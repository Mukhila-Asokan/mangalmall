<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
