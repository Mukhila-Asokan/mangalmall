<?php

namespace Modules\StaffManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\StaffManagement\Database\Factories\DepartmentsFactory;

class Departments extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "departments";

    // protected static function newFactory(): DepartmentsFactory
    // {
    //     // return DepartmentsFactory::new();
    // }
}
