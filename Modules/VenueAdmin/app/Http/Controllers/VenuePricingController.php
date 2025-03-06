<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Modules\Venue\Models\VenueDetails;
Use Modules\VenueAdmin\Models\VenuePricing;
Use Modules\VenueAdmin\Models\VenueUser;
use Modules\VenueAdmin\Models\VenuePriceAddons;
use Modules\VenueAdmin\Models\VenuePricingAddon;

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
        $pricing = VenuePricing::where('delete_status', 0)
                                ->where('created_by', $venueuserid)
                                ->paginate(20); // Assuming you want to show 20 records per page
                              
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
        $venueUserId = Session::get('venueuserid'); // Fetch Session value

        $venues = VenueDetails::whereIn('id', function ($query) use ($venueUserId) {
            $query->select('venueid')
                ->from('uservenue') // Ensure this is the correct table name
                ->where('venueuserid', '=', $venueUserId);
        })->get();
        
        $addons = VenuePriceAddons::where('delete_status', 0)->where('created_by',$venueuserid)->get();
        return view('venueadmin::venuepricing.create',compact('pagetitle','pageroot','venues','addons'));
     
    }
    public function getRate($id)
    {
        $venue = VenueDetails::where('id',$id)->first();
        return response()->json($venue);       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'venue_id' => 'required|integer',
            'pricing_type' => 'required|string|max:255',
            'base_price' => 'required',
            'peak_rate' => 'required',
            'deposit_amount' => 'required',
            'cancellation_policy' => 'required|string',           
        ]);


        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $venuePricing = new VenuePricing();
            $venuePricing->venue_id = $request->venue_id;
            $venuePricing->pricing_type = $request->pricing_type;
            $venuePricing->base_price = $request->base_price;
            $venuePricing->peak_rate = $request->peak_rate;
            $venuePricing->deposit_amount = $request->deposit_amount;
            $venuePricing->cancellation_policy = $request->cancellation_policy;
            $venuePricing->status = 'Active';
            $venuePricing->delete_status = 0; // Assuming new entries are not deleted
            $venuePricing->created_by = Session::get('venueuserid'); // Assuming you want to track who created it
            $venuePricing->save();
            $addonIds = is_array($request->addon_id) ? $request->addon_id : [$request->addon_id];
            $addonPrices = is_array($request->addon_price) ? $request->addon_price : [$request->addon_price];
          
            foreach ($addonIds as $key => $addonId) {
                $venuePricingAddon = new VenuePricingAddon();
                $venuePricingAddon->venuepricingid = $venuePricing->id;
                $venuePricingAddon->addonid = $addonId;
                $venuePricingAddon->addonprice = $addonPrices[$key] ?? 0; // Ensure price exists
                $venuePricingAddon->created_by = Session::get('venueuserid');
                $venuePricingAddon->delete_status = 0;
                $venuePricingAddon->save();
            }

      

            return redirect()->route('venue.pricing')->with('success', 'Venue pricing created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
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
        $pagetitle = "Venue Pricing";
        $pageroot = "Home"; 
        $venuePricing = VenuePricing::findOrFail($id);
        $venues = VenueDetails::whereIn('id', function ($query) use ($venueuserid) {
            $query->select('venueid')
                ->from('uservenue') // Ensure this is the correct table name
                ->where('venueuserid', '=', $venueuserid);
        })->get();
        $addons = VenuePriceAddons::where('delete_status', 0)->where('created_by',$venueuserid)->get();
        $venuePricingAddons = VenuePricingAddon::where('venuepricingid', $id)->get();
        return view('venueadmin::venuepricing.edit', compact('venuePricing', 'venues', 'addons', 'venuePricingAddons', 'pagetitle', 'pageroot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'venue_id' => 'required|integer',
            'pricing_type' => 'required|string|max:255',
            'base_price' => 'required',
            'peak_rate' => 'required',
            'deposit_amount' => 'required',
            'cancellation_policy' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $venuePricing = VenuePricing::findOrFail($id);
            $venuePricing->venue_id = $request->venue_id;
            $venuePricing->pricing_type = $request->pricing_type;
            $venuePricing->base_price = $request->base_price;
            $venuePricing->peak_rate = $request->peak_rate;
            $venuePricing->deposit_amount = $request->deposit_amount;
            $venuePricing->cancellation_policy = $request->cancellation_policy;
            $venuePricing->status = 'Active';
            $venuePricing->delete_status = 0; // Assuming updated entries are not deleted
            $venuePricing->updated_by = Session::get('venueuserid'); // Assuming you want to track who updated it
            $venuePricing->save();

            $addonIds = is_array($request->addon_id) ? $request->addon_id : [$request->addon_id];
            $addonPrices = is_array($request->addon_price) ? $request->addon_price : [$request->addon_price];

            VenuePricingAddon::where('venuepricingid', $id)->delete(); // Remove existing addons

            foreach ($addonIds as $key => $addonId) {
                $venuePricingAddon = new VenuePricingAddon();
                $venuePricingAddon->venuepricingid = $venuePricing->id;
                $venuePricingAddon->addonid = $addonId;
                $venuePricingAddon->addonprice = $addonPrices[$key] ?? 0; // Ensure price exists
                $venuePricingAddon->created_by = Session::get('venueuserid');
                $venuePricingAddon->delete_status = 0;
                $venuePricingAddon->save();
            }

            return redirect()->route('venue.pricing')->with('success', 'Venue pricing updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venuePricing = VenuePricing::findOrFail($id);
        $venuePricing->delete_status = 1;
        $venuePricing->save();
        return redirect()->route('venue.pricing')->with('success', 'Venue pricing deleted successfully.');
    }
    public function updatestatus($id)
    {
        $venuePricing = VenuePricing::findOrFail($id);
        $venuePricing->status = ($venuePricing->status === 'Active') ? 'Inactive' : 'Active';
        $venuePricing->save();
        return redirect()->route('venue.pricing')->with('success', 'Venue pricing status successfully updated.');
    }
}
