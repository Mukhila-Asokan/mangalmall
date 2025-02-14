<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\VenueImageFactory;

class VenueImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['venue_id', 'image_path', 'image_type']; // Allow these fields to be filled

    protected $table = 'venue_images';

    // protected static function newFactory(): VenueImageFactory
    // {
    //     // return VenueImageFactory::new();
    // }


    public function images()
    {
        return $this->hasMany(VenueImage::class); // A venue can have many images
    }
}
