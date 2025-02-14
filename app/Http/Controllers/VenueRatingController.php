<?php

namespace App\Http\Controllers;

use App\Models\VenueRating;
use Illuminate\Http\Request;
use App\Models\VenueRatingCriteria;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class VenueRatingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'venue_id' => 'required|exists:venues,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
            'cleanliness' => 'required|integer|min:1|max:5',
            'service' => 'required|integer|min:1|max:5',
            'value_for_money' => 'required|integer|min:1|max:5',
            'location' => 'required|integer|min:1|max:5',
            'amenities' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $rating = VenueRating::create([
                'venue_id' => $request->venue_id,
                'user_id' => auth()->id(),
                'rating' => $request->rating,
                'review' => $request->review,
                'is_verified' => true, // Set based on your business logic
                'booking_reference' => $request->booking_reference
            ]);

            VenueRatingCriteria::create([
                'venue_rating_id' => $rating->id,
                'cleanliness' => $request->cleanliness,
                'service' => $request->service,
                'value_for_money' => $request->value_for_money,
                'location' => $request->location,
                'amenities' => $request->amenities
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Rating submitted successfully',
                'data' => $rating->load('criteria')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error submitting rating'
            ], 500);
        }
    }

    public function getVenueRatings($venueId)
    {
        $ratings = VenueRating::with(['user', 'criteria'])
            ->where('venue_id', $venueId)
            ->where('is_verified', true)
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $ratings
        ]);
    }
}
