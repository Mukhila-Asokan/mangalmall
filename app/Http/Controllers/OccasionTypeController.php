<?php

namespace App\Http\Controllers;

use App\Models\OccasionType;
use Illuminate\Http\Request;

use Session;

class OccasionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Occasion Types";
        $occasion = OccasionType::where('delete_status','0')->paginate(20);
        return view('admin.occasiontypes.index', compact('pagetitle','pageroot','occasion','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Occasion Types";
     
        return view('admin.occasiontypes.create', compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'eventtypename' => 'required|unique:occasion_types'
         ]);
         $occasion = new OccasionType;
         $occasion->eventtypename = $request->eventtypename;
         $occasion->status = 'Active';
         $occasion->delete_status = 0;
         $occasion->save();  

         return redirect('admin/occasion')->with('success', 'Occasion Type successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(OccasionType $occasionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Occasion Types";
        $occasion = OccasionType::where('id',$id)->first();
        return view('admin.occasiontypes.edit', compact('pagetitle','pageroot','username','occasion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
          $request->validate([
            'eventtypename' => 'required|unique:occasion_types,eventtypename,'.$id.'|max:255',
        ]);

         $occasion = OccasionType::find($id);
         $occasion->eventtypename = $request->eventtypename;
         $occasion->status = 'Active';
         $occasion->delete_status = 0;
         $occasion->save();  

         return redirect('admin/occasion')->with('success', 'Occasion Type successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        OccasionType::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/occasion')->with('success', 'Occasion Type successfully deleted');
    }

    public function updatestatus($id) {    
        $occasion = OccasionType::where('id', '=', $id)->select('status')->first();
        $status = $occasion->status;
        $occasionstatus = "Active";
        if($status == "Active") {
            $occasionstatus = "Inactive";
        }
        OccasionType::where('id', '=', $id)->update(['status' => $occasionstatus]);
        return redirect('admin/occasion')->with('success', 'Occasion Type status successfully updated');
    }
}
