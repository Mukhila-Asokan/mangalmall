<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
use Modules\Venue\Models\VenueDataField;
use Modules\Venue\Models\VenueDataFieldDetails;
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

 
        $venuetypes = VenueType::where('delete_status',0)->where('roottype','=',0)->get();
        $venueamenities = VenueAmenities::where('delete_status','0')->get();
        $currentInstance = VenueDetails::first();

        // Filter venues based on request parameters
        $venuelist = VenueDetails::where('delete_status',0)->paginate(10);
       

        return Inertia::render('VenueSearch', [          
            'venuetypes' => $venuetypes ?? [],
            'venueamenities' => $venueamenities ?? [],
            'venuelist' => $venuelist ?? [],
            'currentInstance' => $currentInstance ?? [],
            'filters' => $request->all(),
        ]);


    }

     public function syncfushindex(Request $request)
    {

    if (!Auth::check()) {
        return response()->json(['error' => 'User is not authenticated'], 401);
    }

 
        $venuetypes = VenueType::where('delete_status',0)->where('roottype','=',0)->get();
        $venueamenities = VenueAmenities::where('delete_status','0')->get();
        $currentInstance = VenueDetails::first();

        // Filter venues based on request parameters
        $venuelist = VenueDetails::where('delete_status',0)->paginate(10);
       

        return Inertia::render('SynVenueSearch', [          
            'venuetypes' => $venuetypes ?? [],
            'venueamenities' => $venueamenities ?? [],
            'venuelist' => $venuelist ?? [],
            'currentInstance' => $currentInstance ?? [],
            'filters' => $request->all(),
        ]);


    }


    public function searchAreas(Request $request)
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


    public function searchvenue(Request $request)
    {
        $query = VenueDetails::query();

        Log::info('Received filters:', $request->all());
     
       
        if ($request->has('searchArea') && $request->searchArea != '') {

            /* $searchAreaId = $request->searchArea;       */    

            $query->where('locationid', $request->searchArea);
            

        }

        if ($request->has('searchType') && $request->searchType != '' ) {
             Log::info('Applying searchType:', [$request->searchType]);
            $query->where('venuetypeid', $request->searchType);
        }

        if ($request->has('searchSubtype')  && $request->searchSubtype != '') {
             Log::info('Applying searchSubtype:', [$request->searchSubtype]);
            $query->where('venuesubtypeid', $request->searchSubtype);
        }

              Log::info('Applying selectedAmenities:', [$request->selectedAmenities]);

           
              if ($request->has('selectedAmenities')  && $request->searchSubtype != '') {
                    $query->whereHas('venueamenitiesapi', function ($query) use ($request) {
                     $selectedAmenities = explode(',', $request->selectedAmenities);
                    $query->whereIn('amenity_id', $selectedAmenities); 
          });
        
        }
        if ($request->has('sortBy') && $request->sortBy != '' ) {
        
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

         $venuelist = $query->paginate(10);  
        return response()->json([           
           'venuelist' => $venuelist ?? [],     
        ], 200);
    }

    public function venuedetails(Request $request)
    {
        $id = $request->id;
        $venuedetail = VenueDetails::where('id',$id)->first();
        $arealocation = indialocation::where('id',$venuedetail->locationid)->first();
        $venuetype = VenueType::where('id',$venuedetail->venuetypeid)->first();
        $venuesubtype = VenueType::where('id',$venuedetail->venuesubtypeid)->first();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafielddetails = VenueDataFieldDetails::where('delete_status',0)->get();

        return view('venuedetail',compact('venuedetail','arealocation','venuetype','venuesubtype','venuedatafield','venueamenities','venuedatafielddetails'));

    }

}