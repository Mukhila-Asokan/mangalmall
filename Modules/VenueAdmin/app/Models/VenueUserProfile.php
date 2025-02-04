<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\VenueAdmin\Database\Factories\VenueUserProfileFactory;

class VenueUserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'venueuserprofile';

    // protected static function newFactory(): VenueUserProfileFactory
    // {
    //     // return VenueUserProfileFactory::new();
    // }
}
