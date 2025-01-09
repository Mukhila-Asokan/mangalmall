<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueGalleryImage;
use Modules\Venue\Models\VenueThemeBuilder;
use Modules\Venue\Models\VenueDetails;
use Illuminate\Support\Facades\Storage;
use DataTables;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue List";
        $pageroot = "Venue"; 
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::where('delete_status',0)->get();


        if ($request->ajax()) {

            $data = VenueDetails::where('delete_status',0)->get();


            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="'.url('admin/venue/detailview/'.$row->id).'" class="edit btn btn-primary btn-sm">View</a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          



        return view('venue::venues.show',compact('pagetitle','pageroot','username','venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    public function venuesettings()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Settings";
        $pageroot = "Venue";        
        return view('venue::venuesettings',compact('pagetitle','pageroot','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue";
        $pageroot = "Home";
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::orderBy('City')->get();
        return view('venue::venues.create',compact('pagetitle','pageroot','username','venuetypes','venueamenities','venuedatafield','arealocation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'venuename' => 'required',
            'venueaddress' => 'required',
            'locationid' => 'required',
            'description' => 'required',
            'contactperson' => 'required',
            'contactmobile' => 'required',
            'contacttelephone' => 'required',
            'contactemail' => 'required',
            'websitename' => 'required',
            'venuetypeid' => 'required',
            'venuesubtypeid' => 'required',
           
         ]);
        $venuedetails = new VenueDetails;
        $venuedetails->venuename = $request->venuename;
        $venuedetails->venueaddress = $request->venueaddress;
        $venuedetails->locationid = $request->locationid;
        $venuedetails->description = $request->description;
        $venuedetails->contactperson = $request->contactperson;
        $venuedetails->contactmobile = $request->contactmobile;
        $venuedetails->contacttelephone = $request->contacttelephone;
        $venuedetails->contactemail = $request->contactemail;
        $venuedetails->websitename = $request->websitename;
        $venuedetails->venuetypeid = $request->venuetypeid;
        $venuedetails->venuesubtypeid = $request->venuesubtypeid;

        $venueamenities = json_encode($request->venueamenities);
        $venuedetails->venueamenities = $venueamenities;
        $venuedatafield = $request->datafieldid;
        $venuedatavalue = $request->datafieldvalue;
        
         
       $veneudata = json_encode($venuedatavalue);
    

        $filename = '';
        if($request->hasFile('bannerimage')){         
            $filename = $request->file('bannerimage')->store('venuebannerimage', 'public');;

        }

       $venuedetails->venuedata = $veneudata;
       $venuedetails->bannerimage = $filename;

   
       $venuedetails->save();



       return redirect('admin/venue/show')->with('success', 'Venue  Details successfully created');

    }

    /**
     * Show the specified resource.
     */

    public function detailview($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Detailed View";
        $pageroot = "Venue"; 
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();         
        $venuedatafielddetails = VenueDataFieldDetails::where('delete_status',0)->get();         
        $venuedetails = VenueDetails::where('id',$id)->first();
        return view('venue::venues.detailview',compact('pagetitle','pageroot','username','venuedetails','venueamenities','venuedatafield','venuedatafielddetails'));
    }


    public function themebuilder($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Detailed View";
        $pageroot = "Venue"; 
        $venueid = $id;
        $theme = VenueThemeBuilder::where('delete_status',0)->get();
        return view('venue::venues.themelistview',compact('pagetitle','pageroot','username','theme','venueid'));
    }

    public function themeeditor($venueid,$id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');   
        $venueid =  $venueid;
        $themeid = $id;
        $pagetitle = "Theme View";
        $pageroot = "Venue"; 
        $venue = VenueDetails::where('id',$venueid)->first();
        $theme = VenueThemeBuilder::where('id',$id)->first();

        return view('venue::venues.showvenuetheme',compact('pagetitle','pageroot','username','userid','theme','venue'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('venue::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxcitylist(Request $request)
    {
        $area_id = $request->area_id;
        $arealocation = indialocation::where('id','=',$area_id)->get();

        return response()->json($arealocation, 200);
    }
    public function ajaxcvenuesubtypelist(Request $request)
    {
        $venuetypeid = $request->venuetypeid;
        $venuesubtype = VenueType::where('roottype','=',$venuetypeid)->get();
        return response()->json($venuesubtype, 200);
    }

}
