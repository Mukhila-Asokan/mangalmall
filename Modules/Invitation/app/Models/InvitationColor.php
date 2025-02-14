<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationColorFactory;

class InvitationColor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'invitationcolor';
    // protected static function newFactory(): InvitationColorFactory
    // {
    //     // return InvitationColorFactory::new();
    // }
}
