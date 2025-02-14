<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Venue\Models\VenueDetails;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VenueRating extends Model
{
    /** @use HasFactory<\Database\Factories\VenueRatingFactory> */
    use HasFactory;

    use SoftDeletes;

    public function venue(): BelongsTo
    {
        return $this->belongsTo(VenueDetails::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function criteria(): HasOne
    {
        return $this->hasOne(VenueRatingCriteria::class);
    }
}
