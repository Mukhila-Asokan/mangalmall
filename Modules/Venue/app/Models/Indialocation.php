<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\IndialocationFactory;

class indialocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = "indialocation";

    // protected static function newFactory(): IndialocationFactory
    // {
    //     // return IndialocationFactory::new();
    // }
}
