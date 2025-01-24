<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\VenueAdmin\Models\VenueUser;
use Modules\VenueAdmin\Models\UserVenue;
use Modules\VenueAdmin\Models\VenueBookingContact;

use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueGalleryImage;
use Modules\Venue\Models\VenueThemeBuilder;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\VenueCampaigns;
use Modules\Venue\Models\Imagelibrary;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use DataTables;
use Session;
use Auth;


class VenueAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('venueadmin::auth.login');
    }

    public function mobileotp(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'mobileno' => 'required', 'string', 'regex:/^[0-9]{10}$/'
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        $mobilenocheck = VenueUser::where('mobileno',$request->mobileno)->first();

        if(!empty($mobilenocheck))
        {
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'OTP Send your mobile, Please check';
        }
        else
        {
            $browserResponse['status']   = 'failed';
            $browserResponse['message']  = 'Please check your mobile no';
        }

       
        return response()->json($browserResponse, 200);
    }


    public function sendotp(Request $request)
    {
         $request->validate([
            'mobileno' => 'required|string|regex:/^[0-9]{10}$/|unique:venueuser',
            'yourname' => 'required',
            'venuecity' => 'required'
        ],[
        'yourname.required' => 'Your name is required, Please enter.',
        ]);

       /* if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }*/

        $browserResponse['status']   = 'success';
        $browserResponse['message']  = 'OTP Send your mobile, Please check';

        return response()->json($browserResponse, 200);
    }

    public function newaccountadd(Request $request)
    {
        $newvenue = new VenueUser();
        $newvenue->name = $request->yourname;
        $newvenue->mobileno = $request->mobileno ;
        $newvenue->city = $request->venuecity ;
        $newvenue->email = 'admin@gmail.com' ;
        $newvenue->role = 'Venue Admin' ;
        $newvenue->status = 'Inactive';
        $newvenue->save();

        return redirect('venue/login')->with('success', 'Registered Successfully, Please login in');
    }

    public function logincheck(Request $request)
    {
        $request->validate([
            'mobileno' => 'required', 'string', 'regex:/^[0-9]{10}$/',
            'mobileotp' => 'required'
        ]);

        $mobilenocheck = VenueUser::where('mobileno',$request->mobileno)->first();



        if(!empty($mobilenocheck))
        {
             $request->session()->put('mobile_verified', true);
             $request->session()->put('username', $mobilenocheck->name);
             $request->session()->put('mobileno', $mobilenocheck->mobileno);
             $request->session()->put('city', $mobilenocheck->city);
             $request->session()->put('email', $mobilenocheck->email);
             $request->session()->put('venueuserid', $mobilenocheck->id);
             
            if($mobilenocheck->status == "Inactive")
            {
                return redirect('venueadmin/inactiveuser')->with('success', 'Please contact Mangal Mall team to activate your account');
            }
            else
            {
                return redirect('venueadmin/dashboard')->with('success', 'Welcome to the dashboard');
            }
        }



        return redirect('venue/login')->with('error', 'Please check your mobile no');
    }

    public function inactiveuser()
    {
        return view('venueadmin::auth.inactiveuser');
    }

    public function createvenue()
    {
        $pagetitle = "Add New Venue";
        $pageroot = "Home"; 
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venueamenities = VenueAmenities::where('delete_status',0)->get();
        $venuedatafield = VenueDataField::where('delete_status',0)->get();
        $arealocation = indialocation::orderBy('City')->get();
        return view('venueadmin::venueuser.create',compact('pagetitle','pageroot','venuetypes','venueamenities','venuedatafield','arealocation'));
    }


    public function storevenue(Request $request)
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
        $venuedetails->googlemap = $request->googlemap;

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

       $uservenue = new UserVenue;
       $uservenue->venueid = $venuedetails->id;
       $uservenue->venueuserid = Session::get('venueuserid');
       $uservenue->save();


       return redirect('venueadmin/venuelist')->with('success', 'Venue Details Successfully updated');
    }

    public function dashboard()
    {
        $pagetitle = "Dashboard";
        $pageroot = "Home"; 
        return view('venueadmin::auth.dashboard',compact('pagetitle','pageroot'));
    }  

    public function register()
    {
      
         return view('venueadmin::auth.register');
    }    
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venueadmin::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request)
    {
        $venueuserid =  Session::get('venueuserid'); 
        $pagetitle = "Venue List";
        $pageroot = "Home"; 

       /* $venues = UserVenue::where('venueuserid',venueuserid)->get();*/

        /* SELECT * FROM `venuedetails` WHERE id = (select venueid from `uservenue` where venueuserid = 1); */


        $venues = VenueDetails::whereIn('id', function($query) {
                                     $query->select('venueid')
                                        ->from('uservenue')
                                        ->where('venueuserid','=',Session::get('venueuserid'));
                                     })->get();


         
        return view('venueadmin::venueuser.list',compact('pagetitle','pageroot','venues'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('venueadmin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/venue/login'); 
    }
}
