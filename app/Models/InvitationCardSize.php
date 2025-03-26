<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationCardSize extends Model
{
    protected $table = 'invitationdigitalcard_size';
    protected $fillable = ['size_name','size_width','size_height','delete_status'];
}
