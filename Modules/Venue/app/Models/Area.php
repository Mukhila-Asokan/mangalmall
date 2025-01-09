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
}
