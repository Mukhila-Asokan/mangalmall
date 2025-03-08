<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\City;
Use Modules\Venue\Models\Area;
use Modules\Venue\Models\VenueAmenities;
use Modules\Venue\Models\VenueDataField;
use Modules\Venue\Models\VenueDataFieldDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\VenueRating;
use Modules\VenueAdmin\Models\UserVenue;
use Modules\VenueAdmin\Models\VenueUser;
use App\Notifications\EnquiryNotification;
use App\Models\BookingEnquiry;
use DB;

class VenueSearchController extends Controller
{
    public function index(Request $request)
    {

    if (!Auth::check()) {
        return redirect()->route('login')->withErrors(['error' => 'User is not authenticated']);
    }
    

 
        $venuetypes = VenueType::where('delete_status',0)->where('roottype','=',0)->get();
        $venueamenities = VenueAmenities::where('delete_status','0')->get();
        $currentInstance = VenueDetails::first();

        // Filter venues based on request parameters
        $query = VenueDetails::where('delete_status',0)->withCount('ratings')->withAvg('ratings', 'rating');
        $perPage = 6;
        $venuelist = $query->paginate($perPage)->appends(request()->query()); 

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
        $areas = City::where('cityname', 'LIKE', "%{$query}%")->limit(10)
                      ->get();

        return response()->json($areas);
    }


    public function searchvenue(Request $request)
    {
        $query = VenueDetails::query();

        Log::info('Received filters:', $request->all());
        $currentPage = $request->page; // Default to 1
       
        $perPage = 6;

        
        if ($request->has('searchArea') && !empty($request->searchArea)) {
            // Find the city by ID
            $city = City::find($request->searchArea);
        
            if ($city) {
                // Get Area IDs that belong to this City
                $areaIds = Area::where('cityid', $city->id)->pluck('id')->toArray();
        
                // If areas exist, filter locations by these area IDs
                if (!empty($areaIds)) {
                    $query->whereIn('locationid', $areaIds);
                }
            }
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

           
              if ($request->has('selectedAmenities')  && $request->selectedAmenities != '') {
                $selectedAmenities = explode(',', $request->selectedAmenities);
                // $query->whereHas('venueamenities', function ($query) use ($selectedAmenities) {
                    foreach ($selectedAmenities as $amenity) {
                        $query->whereRaw("JSON_CONTAINS(venueamenities, ?)", [json_encode((int)$amenity)]);
                    }
                // });
        
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

        
     $venuelist = $query->withCount('ratings')->withAvg('ratings', 'rating')->paginate($perPage, ['*'], 'page', $currentPage)->appends($request->query());

      
        return response()->json([           
           'venuelist' => $venuelist ?? [], 
           'current_page' => $venuelist->currentPage(),
            'last_page' => $venuelist->lastPage(),
            'per_page' => $venuelist->perPage(),
            'total' => $venuelist->total(),    
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
        $venueRating = VenueRating::where('venue_id',$id)->where('user_id', auth()->id())->first();
        $overAllVenueRating = VenueRating::where('venue_id',$id);
        $ratingCount = $overAllVenueRating->count();
        $ratingAvg = $overAllVenueRating->avg('rating');
        $ratingAvg = number_format(round($ratingAvg), 1);
        $commentCount = $overAllVenueRating->whereNotNull('review')->where('is_verified', true)->count();
        $allComments = $overAllVenueRating->whereNotNull('review')->where('is_verified', true)->orderByDesc('created_at')->take(2)->get();

        return view('venuedetail',compact('venuedetail','arealocation','venuetype','venuesubtype','venuedatafield','venueamenities','venuedatafielddetails', 'venueRating', 'ratingAvg', 'ratingCount', 'allComments', 'commentCount'));

    }
    public function adsrandom(Request $request)
    {
        $ads = array(
            array('id' => 1, 'title' => 'Ad 1', 'description' => 'This is Ad 1', 'url' => 'https://www.google.com', 'image' => 'ads/a1.jpg'),
            array('id' => 2, 'title' => 'Ad 2', 'description' => 'This is Ad 2', 'url' => 'https://www.google.com', 'image' => 'ads/ads2.jpg'),
            array('id' => 3, 'title' => 'Ad 3', 'description' => 'This is Ad 3', 'url' => 'https://www.google.com', 'image' => 'ads/a1.jpg'),
            array('id' => 4, 'title' => 'Ad 4', 'description' => 'This is Ad 4','url' => 'https://www.google.com','image' => 'ads/ads2.jpg'),
            array('id' => 5, 'title' => 'Ad 5', 'description' => 'This is Ad 5', 'url' => 'https://www.google.com','image' => 'ads/a1.jpg'), 
            array('id' => 6, 'title' => 'Ad 6', 'description' => 'This is Ad 6','url' => 'https://www.google.com','image' => 'ads/ads2.jpg'),   
        );

        return response()->json([           
           'ads' => $ads ?? [],     
        ], 200);
    }

    public function submitBookingEnquiry(Request $request){
        DB::beginTransaction();
        try{
            $venueDetails = VenueDetails::where('id', $request->id)->first();
            $venueUser = UserVenue::where('venueid', $request->id)->first();
            if($venueUser){
                $createEnquiry = new BookingEnquiry();
                $createEnquiry->venue_id = $request->id;
                $createEnquiry->user_id = auth()->user()->id;
                $createEnquiry->name = $request->name;
                $createEnquiry->mobile_number = $request->phone;
                $createEnquiry->message = $request->message;
                $createEnquiry->booking_date = $request->date;
                $createEnquiry->venue_user_id = $venueUser->venueuserid;
                $createEnquiry->save();

                $user = VenueUser::where('id', $venueUser->venueuserid)->first();
                $userName = auth()->user()->name;
                $data = [
                    'message' => "You received and booking enquiry from $userName",
                    'user_id' => auth()->user()->id,
                    'user_name' => $userName,
                    'venue_id' => $request->id,
                    'type' => 'Venue Booking',
                    'venue_name' => $venueDetails->venuename,
                    'booking_details' => $createEnquiry,
                    'redirection_url' => '',
                ];
                $user->notify(new EnquiryNotification($data));
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Enquiry updated successfully'
                ]);
            }
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}