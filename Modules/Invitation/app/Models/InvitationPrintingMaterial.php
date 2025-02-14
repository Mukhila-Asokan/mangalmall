<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationPrintingMaterialFactory;

class InvitationPrintingMaterial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'invitationprintingmaterial';

    // protected static function newFactory(): InvitationPrintingMaterialFactory
    // {
    //     // return InvitationPrintingMaterialFactory::new();
    // }
}
