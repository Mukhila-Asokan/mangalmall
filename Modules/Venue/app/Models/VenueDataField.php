<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueDataFieldFactory;

use Illuminate\Database\Eloquent\Relations\HasOne;


class VenueDataField extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $table = 'venuedatafield';
    protected $fillable = [];

    // protected static function newFactory(): VenueDataFieldFactory
    // {
    //     // return VenueDataFieldFactory::new();
    // }


    public function datafieldvalues() {
        return $this->hasMany(VenueDataFieldDetails::class,'datafieldid','id');
    }

}
