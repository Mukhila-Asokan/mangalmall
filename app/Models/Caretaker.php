<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caretaker extends Model
{
    use SoftDeletes;
    
    protected $table = 'caretakers';

    protected $guarded = [];
}
