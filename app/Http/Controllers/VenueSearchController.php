<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VenueSearchController extends Controller
{
    public function index(Request $request)
    {

        if (!Auth::check()) {
        return response()->json(['error' => 'User is not authenticated'], 401);
    }

   /* return Inertia::render('VenueSearch', [
        'auth' => ['user' => Auth::user()]
    ]);
*/
        // Fetch initial data
       /* $areas = indialocation::where('delete_status', '0')->select('City')->distinct()
        ->orderBy('City')->get();*/
        $areas = indialocation::where('delete_status', '0')->get();
        $venuetypes = VenueType::where('delete_status',0)->where('roottype','=',0)->get();
        $venueamenities = VenueAmenities::where('delete_status','0')->get();
        $currentInstance = VenueDetails::first();

        // Filter venues based on request parameters
        $query = VenueDetails::query();

        if ($request->has('searchArea')) {
            $locations = indialocation::where('Areaname', 'like', '%' . $request->searchArea . '%')->pluck('id');
            if ($locations->isNotEmpty()) {
                $query->whereIn('locationid', $locations);
            }
        }

        if ($request->has('searchType')) {
            $query->where('venuetypeid', $request->searchType);
        }

        if ($request->has('searchSubtype')) {
            $query->where('venuesubtypeid', $request->searchSubtype);
        }

        if ($request->has('selectedAmenities')) {
            $query->whereHas('venueamenities', function ($query) use ($request) {
                $query->whereIn('id', $request->selectedAmenities);
            });
        }

        if ($request->has('sortBy')) {
            switch ($request->sortBy) {
                case 'price_asc':
                    $query->orderBy('bookingprice', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('bookingprice', 'desc');
                    break;
                case 'featured':
                    $query->orderBy('featured', 'desc');
                    break;
                case 'alphabetical_asc':
                    $query->orderBy('venuename', 'asc');
                    break;
                case 'alphabetical_desc':
                    $query->orderBy('venuename', 'desc');
                    break;
            }
        }

        $venuelist = $query->get();

         Log::info('Rendering area', $areas->toArray());

        return Inertia::render('VenueSearch', [
            'areas' => $areas ?? [],
            'venuetypes' => $venuetypes ?? [],
            'venueamenities' => $venueamenities ?? [],
            'venuelist' => $venuelist ?? [],
            'currentInstance' => $currentInstance ?? [],
            'filters' => $request->all(),
        ]);


    }
    public function searchAreas()
    {
        // Get the search query from the request
        $query = $request->query('query', '');

        // Fetch areas with a case-insensitive search on Areaname or City
        $areas = indialocation::where('Areaname', 'LIKE', "%{$query}%")
                      ->orWhere('City', 'LIKE', "%{$query}%")
                      ->limit(10) // Load only 10 results to optimize performance
                      ->get();

        return response()->json($areas);
    }
}