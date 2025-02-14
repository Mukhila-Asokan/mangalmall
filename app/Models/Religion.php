<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    /** @use HasFactory<\Database\Factories\ReligionFactory> */
    use HasFactory;
    protected $table = 'religions';
}
