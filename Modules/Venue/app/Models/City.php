<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\CityFactory;

class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'city';
    protected $fillable = [];

    // protected static function newFactory(): CityFactory
    // {
    //     // return CityFactory::new();
    // }
}
