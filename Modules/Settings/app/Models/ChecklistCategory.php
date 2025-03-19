<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\ChecklistCategoryFactory;
use App\Models\OccasionType;
use Modules\Settings\Models\ChecklistItems;

class ChecklistCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'checklistcategories';

    // protected static function newFactory(): ChecklistCategoryFactory
    // {
    //     // return ChecklistCategoryFactory::new();
    // }

    public function checklistItems()
    {
        return $this->hasMany(ChecklistItems::class);
    }

    public function occasions()
    {
        return $this->belongsToMany(OccasionType::class, 'event_checklist_assignments');
    }
}
