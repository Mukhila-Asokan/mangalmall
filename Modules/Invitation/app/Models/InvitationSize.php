<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationSizeFactory;

class InvitationSize extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = "invitationsize";

    // protected static function newFactory(): InvitationSizeFactory
    // {
    //     // return InvitationSizeFactory::new();
    // }
}
