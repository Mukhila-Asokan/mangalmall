<?php

namespace Modules\StaffManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\StaffManagement\Database\Factories\StaffDocumentsFactory;

class StaffDocuments extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "staff_documents";

    // protected static function newFactory(): StaffDocumentsFactory
    // {
    //     // return StaffDocumentsFactory::new();
    // }
}
