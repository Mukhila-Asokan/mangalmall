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
            'venue_id' => 'required|exists:venuedetails,id',
            'rating' => 'required|integer|min:1|max:5',
            // 'comments' => 'nullable|string|max:1000',
            // 'cleanliness' => 'required|integer|min:1|max:5',
            // 'service' => 'required|integer|min:1|max:5',
            // 'value_for_money' => 'required|integer|min:1|max:5',
            // 'location' => 'required|integer|min:1|max:5',
            // 'amenities' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $rating = VenueRating::updateOrCreate(
                [
                    'venue_id' => $request->venue_id,
                    'user_id' => auth()->id(),
                ],
                [
                    'rating' => $request->rating,
                    'is_verified' => false,
                    // 'review' => $request->comments,
                    // 'booking_reference' => $request->booking_reference
                ]
            );

            // VenueRatingCriteria::create([
            //     'venue_rating_id' => $rating->id,
            //     'cleanliness' => $request->cleanliness,
            //     'service' => $request->service,
            //     'value_for_money' => $request->value_for_money,
            //     'location' => $request->location,
            //     'amenities' => $request->amenities
            // ]);

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

    public function storeComments(Request $request){
        $validator = Validator::make($request->all(), [
            'venue_id' => 'required|exists:venuedetails,id',
            // 'rating' => 'nullable|integer|min:1|max:5',
            'comments' => 'required|string|max:1000',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $rating = VenueRating::updateOrCreate(
                [
                    'venue_id' => $request->venue_id,
                    'user_id' => auth()->id(),
                ],
                [
                    'rating' => $request->rating,
                    'review' => $request->comments,
                    'is_verified' => false,
                ]
            );
            DB::commit();

            return redirect("home/venuesearch/$request->venue_id/venuedetails")->with('success', 'Venue Comments posted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error submitting rating'
            ], 500);
        }
    }

    public function getComments(Request $request){
        $comments = VenueRating::with('user')
            ->where('venue_id', $request->venue_id)
            ->whereNotNull('review')
            ->where('is_verified', true)
            ->orderByDesc('created_at')
            ->skip($request->count)
            ->take(2)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }
}
