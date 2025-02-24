<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationCardThicknessFactory;

class InvitationCardThickness extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table ='invitationcardthickness';

    // protected static function newFactory(): InvitationCardThicknessFactory
    // {
    //     // return InvitationCardThicknessFactory::new();
    // }
}
