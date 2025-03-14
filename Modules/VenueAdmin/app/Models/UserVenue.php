<?php

namespace Modules\VenueAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\VenueAdmin\Database\Factories\UserVenueFactory;

class UserVenue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "uservenue";

    // protected static function newFactory(): UserVenueFactory
    // {
    //     // return UserVenueFactory::new();
    // }
}
