<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\StateFactory;

class State extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'state';
    protected $fillable = [];

    // protected static function newFactory(): StateFactory
    // {
    //     // return StateFactory::new();
    // }
}
