<?php

namespace Modules\StaffManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\StaffManagement\Database\Factories\StaffWorkHistoryFactory;

class StaffWorkHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "staff_workhistory";

    // protected static function newFactory(): StaffWorkHistoryFactory
    // {
    //     // return StaffWorkHistoryFactory::new();
    // }
}
