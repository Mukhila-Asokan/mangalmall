<?php

namespace Modules\Invitation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Invitation\Database\Factories\InvitationSilhoutteFactory;

class InvitationSilhoutte extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'invitationsilhoutte';

    // protected static function newFactory(): InvitationSilhoutteFactory
    // {
    //     // return InvitationSilhoutteFactory::new();
    // }
}
