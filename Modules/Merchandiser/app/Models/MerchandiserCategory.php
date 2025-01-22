<?php

namespace Modules\Merchandiser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Merchandiser\Database\Factories\MerchandiserCategoryFactory;

class MerchandiserCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
	protected $table = 'merchantcategory';

    // protected static function newFactory(): MerchandiserCategoryFactory
    // {
    //     // return MerchandiserCategoryFactory::new();
    // }
}
