<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Session;
use Modules\Venue\Models\VenueType;

class VenueSubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $menuactive = 1;
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Category";
         $pageroot = "Venue";
         return view('venue::venuesubtype.index', compact('pagetitle','pageroot','username','menuactive'));
        }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuactive = 1;
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Sub Type Creation";
        $pageroot = "Venue";
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        return view('venue::venuesubtype.create',compact('pagetitle','pageroot','username','venuetypes','menuactive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venuetype_name' => 'required|unique:venuetype',
            'roottype' => 'required'
         ]);



         $venuetypename = new VenueType;
         $venuetypename->venuetype_name  = $request->venuetype_name;
         $venuetypename->roottype = $request->roottype;
         $venuetypename->status = 'Active';
         $venuetypename->delete_status = 0;


         $venuetypename->save();       

         return redirect('admin/venuesubtype/show')->with('success', 'Venue type successfully created');
    }

    /**
     * Show the specified resource.
     */
    public function show()
    {
        $menuactive = 1;
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Category";
        $pageroot = "Venue";
     /*   $venuetypename = VenueType::where('delete_status',0)->where('roottype','!=',0)->get();*/

         $venuetypename = VenueType::select('a1.*', 'a2.venuetype_name AS parent_name')
                    ->from('venuetype  AS a1')
                    ->join('venuetype  AS a2', 'a1.roottype', '=', 'a2.id')->where('a1.delete_status',0)
                    ->paginate(10);



        return view('venue::venuesubtype.show',compact('pagetitle','pageroot','username','venuetypename','menuactive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menuactive = 1;
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Category";
        $pageroot = "Venue";
        $venuetypes = VenueType::where('delete_status',0)->where('roottype',0)->get();
        $venuetype = VenueType::where('id',$id)->first();
        return view('venue::venuesubtype.edit',compact('pagetitle','pageroot','username','venuetype','venuetypes','menuactive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
          $request->validate([
            'venuetype_name' => 'required|unique:venuetype,venuetype_name,'.$id.'|max:255',           
        ]);

        $venuetypename = VenueType::find($id);
        $venuetypename->venuetype_name = $request->venuetype_name;
        $venuetypename->roottype = $request->roottype;
        $venuetypename->status = 'Active';
        $venuetypename->delete_status = 0;
        $venuetypename->save();       
        return redirect('admin/venuesubtype/show')->with('success', 'Venue type successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VenueType::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/venuesubtype/show')->with('success', 'Venue Type details successfully deleted');
    }

    public function updatestatus($id) {
        $venuetype = VenueType::where('id', '=', $id)->select('status')->first();
        $status = $venuetype->status;
        $venuetypestatus = "Active";
        if($status == "Active") {
            $venuetypestatus = "Inactive";
        }
        VenueType::where('id', '=', $id)->update(['status' => $venuetypestatus]);
        return redirect('admin/venuesubtype/show')->with('success', 'Venue Subtype status successfully updated');
    }
}
