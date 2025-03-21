<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\BudgetCategoryFactory;

class BudgetCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'budgetcategories';

    // protected static function newFactory(): BudgetCategoryFactory
    // {
    //     // return BudgetCategoryFactory::new();
    // }
}
