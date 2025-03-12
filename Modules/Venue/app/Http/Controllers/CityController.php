<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use Modules\Venue\Models\State;
Use Modules\Venue\Models\District;
Use Modules\Venue\Models\City;
use Illuminate\Support\Facades\Session;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "City";
        $pageroot = "Venue";  
        $pageurl = route('venue');
        $query = City::query();
        if ($request->has('state') && $request->state != '') {
            $query->where('stateid', $request->state);
        }

        
        if ($request->has('district') && $request->district != '') {
            $query->where('districtid', $request->district);
        }
        if ($request->has('search') && $request->search != '') {
            $query->where('cityname', 'like', '%' . $request->search . '%');
        }

       
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('cityname', $request->sort);
        }

        $city = $query->where('delete_status',0)->paginate(20); // Paginate results

        

       /* $city = City::where('delete_status',0)->paginate(20);*/

        $states = State::where('delete_status',0)->get();
        $districts = District::where('delete_status',0)->get();
        return view('venue::city.index',compact('pagetitle','pageroot','username','city','states','districts','pageurl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pageroot = "Venue";
        $pagetitle = "City";
        $pageurl = route('venue');
        $states = State::where('delete_status',0)->get();
        $districts = District::where('delete_status',0)->get();
        return view('venue::city.create',compact('pagetitle','pageroot','username','states','districts','pageurl'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'stateid' => 'required',
            'cityname' => 'required|unique:city|max:255',
            'districtid' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }


        $city = new City();
        $city->cityname  = $request->cityname;
        $city->districtid  = $request->districtid;
        $city->stateid  = $request->stateid;
        $city->status = 'Active';
        $city->delete_status = 0;  
        $city->save();

        return redirect('admin/city')->with('success', 'City details successfully added');
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
        if (!$id) {
            return redirect('admin/city')->with('error', 'City not found.');
        }

        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "city";
        $pageroot = "Venue";
        $city=  City::where('id',$id)->first();
        $districts = District::where('delete_status',0)->get();
        $states = State::where('delete_status',0)->get();
        $pageurl = route('venue');
        return view('venue::city.edit',compact('states','pagetitle','pageroot','username','districts','city','pageurl'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'stateid' => 'required',
            'cityname' => 'required|unique:city,cityname,'.$id.'|max:255',
            'districtid' => 'required'
        ]);
   
        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $city = City::find($id);
        $city->cityname  = $request->cityname;
        $city->districtid  = $request->districtid;
        $city->stateid  = $request->stateid;
        $city->status = 'Active';
        $city->delete_status = 0;
        $city->save();

        return redirect('admin/city')->with('success', 'City details successfully added');     
    }

    public function destroy($id)
    {
        City::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/city')->with('success', 'City details successfully deleted');
    }

    public function updatestatus($id) {    
      
        $city = City::find($id);   
        if (!$city) {
            return redirect('admin/city')->with('error', 'City not found.');
        } 
        $city->status = ($city->status === 'Active') ? 'Inactive' : 'Active';
        $city->save();

        return redirect('admin/city')->with('success', 'City status successfully updated.');
    }


}
