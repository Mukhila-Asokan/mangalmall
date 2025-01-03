<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue List";
        $pageroot = "Venue"; 
        return view('venue::venues.show',compact('pagetitle','pageroot','username'));
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
        return view('venue::venues.create',compact('pagetitle','pageroot','username','venuetypes','venueamenities','venuedatafield'));
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
    public function show($id)
    {
        return view('venue::show');
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
}
