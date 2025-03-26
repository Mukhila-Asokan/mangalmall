<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventItinerary extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'event_itinerary';
}
