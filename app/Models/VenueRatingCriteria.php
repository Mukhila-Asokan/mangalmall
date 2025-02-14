<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VenueRatingCriteria extends Model
{
    use HasFactory;
    protected $table = 'venue_rating_criteria';

    public function rating(): BelongsTo
    {
        return $this->belongsTo(VenueRating::class, 'venue_rating_id');
    }
}
