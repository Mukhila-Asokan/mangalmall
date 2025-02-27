<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\AreaFactory;

class Area extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'area';
    protected $fillable = [];

    // protected static function newFactory(): AreaFactory
    // {
    //     // return AreaFactory::new();
    // }

    public function city()
    {
        return $this->belongsTo(City::class, 'cityid', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'districtid', 'id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'stateid', 'id');
    }

    public function venueDetails()
    {
        return $this->belongsTo(VenueDetails::class, 'locationid', 'id');
    }
}
