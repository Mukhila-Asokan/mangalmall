<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Venue\Models\VenueAmenities;
use Session;

class VenueAmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Amenities";
         $pageroot = "Venue";
         $venueamenities = VenueAmenities::where('delete_status',0)->paginate(10);
         return view('venue::venueamenities.show', compact('pagetitle','pageroot','username','venueamenities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Amenities";
         $pageroot = "Venue";
         
        return view('venue::venueamenities.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amenities_name' => 'required|unique:venueamenities'
         ]);

         $venueamenities = new VenueAmenities;
         $venueamenities->amenities_name  = $request->amenities_name;        
         $venueamenities->status = 'Active';
         $venueamenities->delete_status = 0;
         $venueamenities->save();       

         return redirect('admin/venueamenities/show')->with('success', 'Venue Amenities successfully created');
    }

    /**
     * Show the specified resource.
     */
    public function show()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Amenities";
         $pageroot = "Venue";
         $venueamenities = VenueAmenities::where('delete_status',0)->paginate(10);
         return view('venue::venueamenities.show', compact('pagetitle','pageroot','username','venueamenities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Amenities";
        $pageroot = "Venue";
        $venueamenities = VenueAmenities::where('id',$id)->first();
        return view('venue::venueamenities.edit',compact('pagetitle','pageroot','username','venueamenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $id = $request->id;
          $request->validate([
            'amenities_name' => 'required|unique:venueamenities,amenities_name,'.$id.'|max:255',           
        ]);

        $venueamenities = VenueAmenities::find($id);
        $venueamenities->amenities_name = $request->amenities_name;       
        $venueamenities->status = 'Active';
        $venueamenities->delete_status = 0;
        $venueamenities->save();       
        return redirect('admin/venueamenities/show')->with('success', 'Venue Amenities successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VenueAmenities::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/venueamenities/show')->with('success', 'Venue Amenities details successfully deleted');
    }
     public function updatestatus($id) {    
        $venuemenities = VenueAmenities::where('id', '=', $id)->select('status')->first();
        $status = $venuemenities->status;
        $venuemenitiesstatus = "Active";
        if($status == "Active") {
            $venuemenitiesstatus = "Inactive";
        }
        VenueAmenities::where('id', '=', $id)->update(['status' => $venuemenitiesstatus]);
        return redirect('admin/venueamenities/show')->with('success', 'Venue Amenities status successfully updated');
    }
}
