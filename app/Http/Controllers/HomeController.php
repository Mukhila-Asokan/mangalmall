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
use Modules\Venue\Models\VenueDetails;


class HomeController extends Controller
{
    public function home()
    {

        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();       
        $arealocation = indialocation::where('delete_status',0)->get();
        return view('layouts.home',compact('venuetypes','arealocation'));
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

        if($request->venuearea != "")
        {
            $query->where('locationid','=',$request->venuearea);
        }
        if($request->venuetype != "")
        {
            $query->where('venuetypeid','=',$request->venuetype);
        }
        if($request->venusubtype != "")
        {
            $query->where('venuesubtypeid','=',$request->venusubtype);
        }
        
        $venue = $query->get();
        if ($venue->isEmpty()) {
            $message = "No Records Found" ;
            $recordcount = 0;
            
    }      
         else {
             $recordcount = count($venue);
             $message = " Total No of Records = ".count($venue);
  
        }
      
        return response()->json(array('message' => $message, 'venue' => $venue, 'recordcount'=> $recordcount), 200);
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
}
