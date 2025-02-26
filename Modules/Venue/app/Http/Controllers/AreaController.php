<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use Modules\Venue\Models\State;
Use Modules\Venue\Models\District;
Use Modules\Venue\Models\City;
use Modules\Venue\Models\Area;
use Illuminate\Support\Facades\Log;
use Session;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Area";
        $pageroot = "Venue";  
        $query = Area::query();
        
        if ($request->has('city') && $request->city != '') {
            $query->where('cityid', $request->city);
        }

        if ($request->has('district') && $request->district != '') {
            $query->where('districtid', $request->district);
        }

        if ($request->has('state') && $request->state != '') {
            $query->where('stateid', $request->state);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('areaname', 'like', '%' . $request->search . '%');
        }

        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('areaname', $request->sort);
        }
       
        $area = $query->where('delete_status', 0)->paginate(20); // Paginate results

        $cities = City::where('delete_status', 0)->get();
        $districts = District::where('delete_status', 0)->get();
        $states = State::where('delete_status', 0)->get();

        return view('venue::area.index', compact('pagetitle', 'pageroot', 'username', 'area', 'cities', 'districts', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pageroot = "Venue";
        $pagetitle = "Area";
        $states = State::where('delete_status', 0)->get();
        $districts = District::where('delete_status', 0)->get();
        $cities = City::where('delete_status', 0)->get();
        return view('venue::area.create', compact('pagetitle', 'pageroot', 'username', 'states', 'districts', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'areaname' => 'required',
            'pincode' => 'required',
            'stateid' => 'required',
            'districtid' => 'required',
            'cityid' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
          
            $area = new Area();
            $area->areaname = $request->areaname;
            $area->stateid = $request->stateid;
            $area->districtid = $request->districtid;
            $area->cityid = $request->cityid;
            $area->pincode = $request->pincode;
            $area->delete_status = 0;
            $area->status = 'Active';
            $area->save();
            return redirect()->route('venue.area')->with('success', 'Area created successfully.');
        } catch (\Exception $e) {
            \Log::error("Error creating area: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the area.')->withInput();
        }
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
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pageroot = "Venue";
        $pagetitle = "Area";
        $states = State::where('delete_status', 0)->get();
        $districts = District::where('delete_status', 0)->get();
        $cities = City::where('delete_status', 0)->get();
        $area = Area::findOrFail($id);
        return view('venue::area.edit', compact('pagetitle', 'pageroot', 'username', 'states', 'districts', 'cities', 'area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'areaname' => 'required',
            'pincode' => 'required',
            'stateid' => 'required',
            'districtid' => 'required',
            'cityid' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $area = Area::findOrFail($id);
            $area->areaname = $request->areaname;
            $area->stateid = $request->stateid;
            $area->districtid = $request->districtid;
            $area->cityid = $request->cityid;
            $area->pincode = $request->pincode;
            $area->status = $request->status ?? 'Active';
            $area->save();

            return redirect()->route('venue.area')->with('success', 'Area updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the area.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $area = Area::findOrFail($id);
            $area->delete_status = 1;
            $area->save();

            return redirect()->route('venue.area')->with('success', 'Area details successfully deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the area.');
        }
    }


    public function updatestatus($id)
    {
        $area = Area::find($id);
        if (!$area) {
            return redirect()->route('venue.area')->with('error', 'Area not found.');
        }
        $area->status = ($area->status === 'Active') ? 'Inactive' : 'Active';
        $area->save();

        return redirect()->route('venue.area')->with('success', 'Area status successfully updated.');
    }
}
