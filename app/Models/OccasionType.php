<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Models\ChecklistCategory;

class OccasionType extends Model
{
    /** @use HasFactory<\Database\Factories\OccasionTypeFactory> */
    use HasFactory;

    public function dataFields()
    {
        return $this->hasMany(OccasionDataField::class, 'occasion_id'); 
    }
    public function checklistcategories()
    {
        return $this->belongsToMany(ChecklistCategory::class, 'event_checklist_assignments');
    }
}
