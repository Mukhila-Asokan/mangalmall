<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use Modules\Venue\Models\State;
Use Modules\Venue\Models\District;
use Illuminate\Support\Facades\Session;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "District";
        $pageroot = "Venue";
        $pageurl = route('venue');
        $query = District::query();

        // Filtering by category
        if ($request->has('state') && $request->state != '') {
            $query->where('stateid', $request->state);
        }

        // Searching by name
        if ($request->has('search') && $request->search != '') {
            $query->where('districtname', 'like', '%' . $request->search . '%');
        }

        // Sorting by price (asc or desc)
        if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
            $query->orderBy('districtname', $request->sort);
        }

        $district = $query->where('delete_status',0)->paginate(20); // Paginate results


        /*$district = District::where('delete_status',0)->paginate(20);*/
        $states = State::where('delete_status',0)->get();
        return view('venue::district.index',compact('pagetitle','pageroot','username','district','states','pageurl'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "District";
        $pageroot = "Venue";
        $pageurl = route('venue');
        $states = State::where('delete_status',0)->get();
        return view('venue::district.create',compact('pagetitle','pageroot','username','states','pageurl'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'stateid' => 'required',
            'districtname' => 'required|unique:district'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

            $district = new District;
            $district->districtname  = $request->districtname;
            $district->stateid  = $request->stateid;
            $district->status = 'Active';
            $district->delete_status = 0;
            $district->save();

        return redirect('admin/district')->with('success', 'District details successfully added');    
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
        $pagetitle = "District";
        $pageroot = "Venue";
        $pageurl = route('venue');
        $district = District::where('id',$id)->first();
        $states = State::where('delete_status',0)->get();
        return view('venue::district.edit',compact('states','pagetitle','pageroot','username','district','pageurl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            $validator = Validator::make($request->all(),[
                'stateid' => 'required',
                'districtname' => 'required|unique:district,districtname,'.$id.'|max:255'
            ]);
       
            if ($validator->fails()) {
                return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
            }

            $district = District::find($id);
            $district->districtname  = $request->districtname;
            $district->stateid  = $request->stateid;
            $district->status = 'Active';
            $district->delete_status = 0;
            $district->save();

            return redirect('admin/district')->with('success', 'District details successfully added');     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        District::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/district')->with('success', 'District details successfully deleted');
    }

    public function updatestatus($id) {    
      
        $district = District::find($id);   
        if (!$district) {
            return redirect('admin/district')->with('error', 'District not found.');
        } 
        $district->status = ($district->status === 'Active') ? 'Inactive' : 'Active';
        $district->save();

        return redirect('admin/district')->with('success', 'District status successfully updated.');
    }
}
