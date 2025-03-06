<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Modules\VenueAdmin\Models\VenuePriceAddons;


class BookingAdonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venueuserid =  Session::get('venueuserid'); 
        $pagetitle = "Venue Booking Addons";
        $pageroot = "Home"; 
        $addons = VenuePriceAddons::where('delete_status', 0)->paginate(20);
        return view('venueadmin::bookingadon.index', compact('addons',  'pagetitle', 'pageroot'));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $venueuserid =  Session::get('venueuserid'); 
        $pagetitle = "Venue Booking Addons";
        $pageroot = "Home"; 
        return view('venueadmin::bookingadon.create',compact('pagetitle','pageroot'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'addonname' => 'required|unique:venuepriceaddons,addonname,NULL,id,created_by,' . Session::get('venueuserid'),
            'price' => 'required',
            'addon_description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $venueuserid =  Session::get('venueuserid'); 
            $addon = new VenuePriceAddons;
            $addon->addonname = $request->addonname;
            $addon->price = $request->price;
            $addon->addon_description = $request->addon_description;
            $addon->created_by = $venueuserid;
            $addon->delete_status = 0;
            $addon->status = 'Active';
            $addon->save();
            return redirect()->route('venue.bookingadons')->with('success', 'Addon created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error creating the addon: ' . $e->getMessage())->withInput();
        }
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
        $venueuserid =  Session::get('venueuserid'); 
        $pagetitle = "Venue Booking Addons";
        $pageroot = "Home"; 
        $bookingadon = VenuePriceAddons::find($id);
        if (!$bookingadon) {
            return redirect()->route('venue.bookingadons')->with('error', 'Addon not found.');
        }
        return view('venueadmin::bookingadon.edit', compact('bookingadon', 'pagetitle', 'pageroot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'addonname' => 'required|unique:venuepriceaddons,addonname,' . $id . ',id,created_by,' . Session::get('venueuserid'),
            'price' => 'required',
            'addon_description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $venueuserid =  Session::get('venueuserid'); 
            $addon = VenuePriceAddons::find($id);
            if (!$addon) {
            return redirect()->route('venue.bookingadons')->with('error', 'Addon not found.');
            }
            $addon->addonname = $request->addonname;
            $addon->price = $request->price;
            $addon->addon_description = $request->addon_description;
            $addon->created_by = $venueuserid;
            $addon->save();
            return redirect()->route('venue.bookingadons')->with('success', 'Addon updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error updating the addon: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $addon = VenuePriceAddons::find($id);
        if (!$addon) {
            return redirect()->route('venue.bookingadons')->with('error', 'Addon not found.');
        }
        $addon->delete_status = 1;
        $addon->save();
        return redirect()->route('venue.bookingadons')->with('success', 'Addon deleted successfully.');
    }

    public function updatestatus($id)
    {
        $addon = VenuePriceAddons::find($id);
        if (!$addon) {
            return redirect()->route('venue.bookingadons')->with('error', 'Addon not found.');
        }
        $addon->status = ($addon->status === 'Active') ? 'Inactive' : 'Active';
        $addon->save();

        return redirect()->route('venue.bookingadons')->with('success', 'Addon status successfully updated.');
    }
}
