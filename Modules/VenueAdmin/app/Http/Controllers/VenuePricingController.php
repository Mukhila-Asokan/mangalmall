<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Modules\Venue\Models\VenueDetails;
Use Modules\VenueAdmin\Models\VenuePricing;
Use Modules\VenueAdmin\Models\VenueUser;

class VenuePricingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venueuserid =  Session::get('venueuserid');
        $pagetitle = "Venue Pricing";
        $pageroot = "Home";
        $pricing = VenuePricing::where('delete_status', 0)->paginate(20);
        return view('venueadmin::venuepricing.index', compact('pricing',  'pagetitle', 'pageroot'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $venueuserid =  Session::get('venueuserid');
        $pagetitle = "Venue Pricing";
        $pageroot = "Home";
        $venueDetails = VenueUser::where('venueuserid', Session::get('userid'))
        ->with('venue')
        ->first()
        ->venue;
    
        return view('venueadmin::venuepricing.create',compact('pagetitle','pageroot'));
     
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
}
