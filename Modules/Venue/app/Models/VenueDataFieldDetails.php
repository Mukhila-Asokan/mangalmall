<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueDataFieldDetailsFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VenueDataFieldDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'venuedatafielddetails';
    protected $fillable = [];

    // protected static function newFactory(): VenueDataFieldDetailsFactory
    // {
    //     // return VenueDataFieldDetailsFactory::new();
    // }


    
}
