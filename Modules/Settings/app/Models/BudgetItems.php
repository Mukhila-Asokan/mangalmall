<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\BudgetItemsFactory;

class BudgetItems extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'budget_items';
    // protected static function newFactory(): BudgetItemsFactory
    // {
    //     // return BudgetItemsFactory::new();
    // }

    public function budgetCategory()
    {
        return $this->belongsTo(BudgetCategory::class, 'budget_category_id');
    }
}
