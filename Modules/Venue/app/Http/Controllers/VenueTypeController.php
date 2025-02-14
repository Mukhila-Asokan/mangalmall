<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Modules\Venue\Models\VenueType;

class VenueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Category";
         $pageroot = "Venue";
         return view('venue::venuetype.index', compact('pagetitle','pageroot','username'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Category";
         $pageroot = "Venue";
         
        return view('venue::venuetype.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'venuetype_name' => 'required|unique:venuetype'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

         $venuetypename = new VenueType;
         $venuetypename->venuetype_name  = $request->venuetype_name;
         $venuetypename->roottype = 0;
         $venuetypename->status = 'Active';
         $venuetypename->delete_status = 0;
         $venuetypename->save();       

         return redirect('admin/venuetype/show')->with('success', 'Venue type successfully created');
    }

    /**
     * Show the specified resource.
     */
    public function show()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Category";
        $pageroot = "Venue";
        $venuetypename = VenueType::where('delete_status',0)->where('roottype',0)->get();
        return view('venue::venuetype.show',compact('pagetitle','pageroot','username','venuetypename'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Category";
        $pageroot = "Venue";
        $venuetype = VenueType::where('id',$id)->first();
        return view('venue::venuetype.edit',compact('pagetitle','pageroot','username','venuetype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        
        $validator = Validator::make($request->all(),[
            'venuetype_name' => 'required|unique:venuetype,venuetype_name,'.$id.'|max:255',           
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

        $venuetypename = VenueType::find($id);
        $venuetypename->venuetype_name = $request->venuetype_name;
        $venuetypename->roottype = 0;
        $venuetypename->status = 'Active';
        $venuetypename->delete_status = 0;
        $venuetypename->save();       
        return redirect('admin/venuetype/show')->with('success', 'Venue type successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VenueType::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/venuetype/show')->with('success', 'Venue Type details successfully deleted');
    }

     public function updatestatus($id) {
        $venuetype = VenueType::where('id', '=', $id)->select('status')->first();
        $status = $venuetype->status;
        $venuetypestatus = "Active";
        if($status == "Active") {
            $venuetypestatus = "Inactive";
        }
        VenueType::where('id', '=', $id)->update(['status' => $venuetypestatus]);
        return redirect('admin/venuetype/show')->with('success', 'Venue Type status successfully updated');
    }

}
