<?php

namespace Modules\StaffManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\StaffManagement\Database\Factories\StaffSkillsFactory;

class StaffSkills extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "staff_skills";

    // protected static function newFactory(): StaffSkillsFactory
    // {
    //     // return StaffSkillsFactory::new();
    // }
}
