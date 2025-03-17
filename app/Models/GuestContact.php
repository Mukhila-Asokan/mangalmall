<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestContact extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function groups(){
        return $this->hasMany(GuestGroupContact::class, 'guest_id', 'id');
    }
 
    public function guestCaretaker(){
        return $this->hasOne(GuestCaretaker::class, 'guest_id', 'id');
    }
}
