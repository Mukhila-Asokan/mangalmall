<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Settings\Database\Factories\ChecklistFactory;
use App\Models\OccasionType;

class Checklist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    protected $table = 'checklists';

    // protected static function newFactory(): ChecklistFactory
    // {
    //     // return ChecklistFactory::new();
    // }

    public function occasion()
    {
        return $this->belongsTo(OccasionType::class);
    }
}
