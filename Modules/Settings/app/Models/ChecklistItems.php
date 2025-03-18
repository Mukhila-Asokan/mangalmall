<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\ChecklistItemsFactory;

class ChecklistItems extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $table = 'category_checklist_items';

    // protected static function newFactory(): ChecklistItemsFactory
    // {
    //     // return ChecklistItemsFactory::new();
    // }

    public function checklistcategory()
    {
        return $this->belongsTo(ChecklistCategory::class, 'category_id');
    }
}
