<?php

namespace Modules\Subcription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Subcription\Database\Factories\UserMenuFactory;

class UserMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'usermenu';

   public function parentmenu()
   {
        return $this->belongsTo(UserMenu::class, 'parentid', 'id');
   }
}
