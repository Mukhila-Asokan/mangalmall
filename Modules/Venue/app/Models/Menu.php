<?php

namespace Modules\Venue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Venue\Database\Factories\MenuFactory;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'menu';

    // protected static function newFactory(): MenuFactory
    // {
    //     // return MenuFactory::new();
    // }

    public function parentname()
    {
        return $this->belongsTo(Menu::class, 'parentid', 'id');
    }
}
