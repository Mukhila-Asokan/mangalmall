<?php

namespace Modules\StaffManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\StaffManagement\Database\Factories\StaffQualificationFactory;

class StaffQualification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "staff_qualification";

    // protected static function newFactory(): StaffQualificationFactory
    // {
    //     // return StaffQualificationFactory::new();
    // }
}
