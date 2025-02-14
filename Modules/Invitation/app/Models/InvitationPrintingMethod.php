<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationPrintingMethodFactory;

class InvitationPrintingMethod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = "invitationprintingmethod";

    // protected static function newFactory(): InvitationPrintingMethodFactory
    // {
    //     // return InvitationPrintingMethodFactory::new();
    // }
}
