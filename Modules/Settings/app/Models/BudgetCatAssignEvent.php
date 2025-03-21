<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\BudgetCatAssignEventFactory;
use App\Models\OccasionType;

class BudgetCatAssignEvent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'budget_events';

    public function budgetCategory()
    {
        return $this->belongsTo(BudgetCategory::class, 'category_id');
    }
    public function occasion()
    {
        return $this->belongsTo(OccasionType::class, 'occasion_id');
    }

    // protected static function newFactory(): BudgetCatAssignEventFactory
    // {
    //     // return BudgetCatAssignEventFactory::new();
    // }
}
