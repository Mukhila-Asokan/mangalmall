<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueThemeBuilderFactory;

class VenueThemeBuilder extends Model
{
    use HasFactory;
    protected $table = 'venuethemebuilder';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): VenueThemeBuilderFactory
    // {
    //     // return VenueThemeBuilderFactory::new();
    // }
}
