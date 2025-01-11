<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\ImagelibraryFactory;

class Imagelibrary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'imagelibrary';
    protected $fillable = [];

    // protected static function newFactory(): ImagelibraryFactory
    // {
    //     // return ImagelibraryFactory::new();
    // }
}
