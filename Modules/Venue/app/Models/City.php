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
    public function state()
    {
        return $this->belongsTo(State::class,'stateid');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'districtid');
    }
}
