<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Modules\StaffManagement\Models\staff;
use Modules\VenueAdmin\Models\VenueUser;
use Modules\VenueAdmin\Models\VenueStaff;
use Modules\VenueAdmin\Models\VenueUserProfile;
use Illuminate\Support\Facades\Session;

class VenueUserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $venueuserid =  Session::get('venueuserid'); 
        $pagetitle = "Profile Page";
        $pageroot = "Home"; 
        $staff = staff::where('delete_status','0')->get();
        $venueuser = VenueUser::where('id',$venueuserid)->first();
		if($venueuser->role == "Staff")
		{
			$venuestaff = VenueStaff::where('venue_user_id',$venueuserid)->first();
			$venueuserprofile = VenueUserProfile::where('venueuserid',$venuestaff->venue_admin_id)->first();
		}
		else
		{
			$venueuserprofile = VenueUserProfile::where('venueuserid',$venueuserid)->first();
		}
      
        return view('venueadmin::profile.index',compact('pagetitle','pageroot','staff','venueuser','venueuserprofile'));
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
         $request->validate([
            'refferance' => 'required',
            'name' => 'required',
            'email' => 'required',
            'city' => 'required',
            'contact_address' => 'required',
        ]);

         $venueuserid =  Session::get('venueuserid'); 
         $alreadycheck = VenueUserProfile::where('venueuserid',$venueuserid)->first();
        

         if(!empty($alreadycheck))
         {
            $userprofile = VenueUserProfile::find($venueuserid);           
         }
         else
         {
            $userprofile = new VenueUserProfile;
            $userprofile->venueuserid = $venueuserid;
         }
        
         $userprofile->refferanceid = $request->refferance;
         $userprofile->contact_address = $request->contact_address;
         
         $userprofile->save();

         $venueuser = VenueUser::find($venueuserid);
         $venueuser->name = $request->name;
         $venueuser->email = $request->email;
         $venueuser->city = $request->city;
         $venueuser->save();

         return redirect('venueadmin/userprofile')->with('success', 'Profile Successfully updated');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('venueadmin::show');
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
    public function destroy($id)
    {
        //
    }
    public function changemobileno()
    {
        $venueuserid =  Session::get('venueuserid'); 
        $pagetitle = "Profile Page";
        $pageroot = "Home"; 
        return view('venueadmin::profile.changemobileno',compact('pagetitle','pageroot'));
    }
}
