<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\DistrictFactory;

class District extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'district';
    protected $fillable = [];

    // protected static function newFactory(): DistrictFactory
    // {
    //     // return DistrictFactory::new();
    // }
}
