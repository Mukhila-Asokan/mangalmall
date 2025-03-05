<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestGroupContact extends Model
{
    use SoftDeletes;

    protected $table = 'guest_group_contacts';
    
    protected $guarded = [];

    public function contact(){
        return $this->belongsTo(GuestContact::class, 'guest_id', 'id');
    }

    public function group(){
        return $this->belongsTo(GuestGroup::class, 'group_id', 'id');
    }
}
