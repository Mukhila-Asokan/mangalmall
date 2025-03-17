<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueGalleryImage;
use Modules\Venue\Models\VenueThemeBuilder;
use Modules\Venue\Models\State;
use Modules\Venue\Models\City;
use Modules\Venue\Models\VenueDetails;
use Illuminate\Support\Facades\Session;
use Modules\Venue\Models\Area;
use Modules\Blog\Models\BlogCategory;
use Modules\Blog\Models\BlogTag;

use Illuminate\Support\Facades\Response;
use App\Models\UserBlog;
class HomeController extends Controller
{
    public function home()
    {

        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();       
        $arealocation = indialocation::where('delete_status',0)->get();
        $state = State::where('delete_status',0)->get();
        $city = City::where('delete_status',0)->get();
        $userblog  = UserBlog::where('delete_status',0)->where('status','Active')->where('blogstatus','published')->orderby('created_at', 'desc')->limit(5)->get();
        return view('layouts.home',compact('venuetypes','arealocation','city','state','userblog'));
    }
    public function ajaxcvenuesubtypelist(Request $request)
    {
        $venuetypeid = $request->venuetypeid;
        $venuesubtype = VenueType::where('roottype','=',$venuetypeid)->get();
        return response()->json($venuesubtype, 200);
    }


public function venuesearchresults(Request $request)
{
    $query = VenueDetails::query(); 

    if (!empty($request->venuearea)) {
        $query->where('locationid', '=', $request->venuearea);
    }
    if (!empty($request->venuetype)) {
        $query->where('venuetypeid', '=', $request->venuetype);
    }

   
    $perPage = 10;
    $venues = $query->paginate($perPage);

    
    return response()->json([
        'message' => $venues->total() > 0 ? "Total No of Records = " . $venues->total() : "No Records Found",
        'venue' => $venues->items(),  // Only the current page data
        'recordcount' => $venues->total(), // Total records count
        'current_page' => $venues->currentPage(),
        'last_page' => $venues->lastPage(),
        'per_page' => $venues->perPage(),
    ]);
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

        return view('home.venuedetail',compact('venuedetail','arealocation','venuetype','venuesubtype','venuedatafield','venueamenities','venuedatafielddetails'));

    }
    public function ajaxstate(Request $request)
    {
        $stateid = $request->state;
        $city = City::where('state_id','=',$stateid)->get();
        return response()->json($city, 200);
    }
    public function chooselocation(Request $request)
    {
        $stateid = $request->state;
        $cityid = $request->city;
        $state = State::where('id','=',$stateid)->first();        
        $city = City::where('id','=',$cityid)->first();
      /*  $statename = $state->statename;
        $cityname = $city->cityname;    */
    
   

        $arealocation = Area::where('City','=',$cityid)->where('State','=',$stateid)->pluck('Areaname')->toArray();
        Session::put('city', $cityname ?? '');
        Session::put('state', $statename ?? '');
       /* $areaContent = '';  
  
        foreach ($arealocation as $key => $area) {
            $areaContent .= '{id: '.$area['id'].', title: "' . $area['Areaname'].' - '.$area['City'].'"},'; 
        }

        $areaContent = rtrim($areaContent, ','); 
    */

  
        
     return response()->json($arealocation, 200);
    }

    public function ajaxCitySearch(Request $request)
    {
        $query = $request->input('query');
        
        $aarea = City::where('cityname', 'LIKE', "%{$query}%")->pluck('cityname')->toArray();

        return response()->json($aarea);
    }

    public function dashboard()
    {
        $userblog = UserBlog::where('delete_status', '0')->orderby('created_at', 'desc')->limit(6)->get();
        return view('dashboard',compact('userblog'));
    }

    public function show($id)
    {       
        $userblog = UserBlog::where('id',$id)->first(); 
        $categories = BlogCategory::withCount('blogs') 
        ->where('delete_status', '0')          
        ->inRandomOrder()                      
        ->limit(6)                             
        ->get();

        $tags = BlogTag::where('delete_status','0')->inRandomOrder()   // Randomize order
        ->limit(6)          // Limit to 6 records
        ->get();;       
        $userblog->views = $userblog->views + 1;
        $userblog->save();       
        $recentpost = UserBlog::where('delete_status','0')->where('status','Active')->where('blogstatus','published')   
               ->orderBy('created_at','desc')->limit(5)->get();
        return view('layouts.showblog',compact('userblog','categories','tags','recentpost'));
    }


}