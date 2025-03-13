<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuestCaretaker extends Model
{
    use SoftDeletes;

    protected $table = 'guest_caretakers';

    protected $guarded = [];

    public function contact(){
        return $this->belongsTo(GuestContact::class, 'guest_id', 'id');
    }
}
