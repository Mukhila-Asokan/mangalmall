<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationModelFactory;

class InvitationModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = "invitationmodel";

    // protected static function newFactory(): InvitationModelFactory
    // {
    //     // return InvitationModelFactory::new();
    // }
}
