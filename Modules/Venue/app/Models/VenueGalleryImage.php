<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueGalleryImageFactory;

class VenueGalleryImage extends Model
{
    use HasFactory;
    protected $table = 'venuegalleryimage';

    /**
     * The attributes that are mass assignable. venuegalleryimage
     */
    protected $fillable = [];

    // protected static function newFactory(): VenueGalleryImageFactory
    // {
    //     // return VenueGalleryImageFactory::new();
    // }
}
