<?php

namespace Modules\StaffManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\StaffManagement\Database\Factories\RolesFactory;

use Illuminate\Database\Eloquent\Relations\HasOne;

class Roles extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $roles = 'roles';

    // protected static function newFactory(): RolesFactory
    // {
    //     // return RolesFactory::new();
    // }

    public function departments()
    {
        return $this->hasOne(Departments::class,'id','departmentid');
    }


}
