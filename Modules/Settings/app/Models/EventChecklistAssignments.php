<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\EventChecklistAssignmentsFactory;

use App\Models\OccasionType;

class EventChecklistAssignments extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'event_checklist_assignments';

    // protected static function newFactory(): EventChecklistAssignmentsFactory
    // {
    //     // return EventChecklistAssignmentsFactory::new();
    // }

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'category_id');
    }
   public function occasion()
    {
        return $this->belongsTo(OccasionType::class, 'occasion_id');
    }
}
