<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use Modules\Venue\Models\VenueDataField;
Use Modules\Venue\Models\VenueDataFieldDetails;

use Session;
class VenueDataFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('venue::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Data Field";
        $pageroot = "Venue";
        return view('venue::venuedatafield.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "Venue Data Field";
         $pageroot = "Venue";

         $request->validate([
            'datafieldtype' => 'required',
            'datafieldname' => 'required'
         ]);

         $datafield = new VenueDataField;
         $datafield->datafieldtype  = $request->datafieldtype;
         $datafield->datafieldname  = $request->datafieldname;
         $datafield->datafieldnametype  = $request->datafieldnametype;
      
         $datafield->status = 'Active';
         $datafield->delete_status = 0;
         $datafield->save();


         $datafieldid = $datafield->id;

         if($datafield->datafieldtype != 'Text' && $datafield->datafieldtype != 'Textarea')
         {
            $optionname = $request->optionname;
            for($i=0;$i<count($optionname);$i++)
            {
                $datafieldvalue = new VenueDataFieldDetails;
                $datafieldvalue->datafieldid = $datafieldid;
                $datafieldvalue->optionname = $request->optionname[$i];
                $datafieldvalue->status = 'Active';
                $datafieldvalue->delete_status = 0;
                $datafieldvalue->save();
            }
         }


         return redirect('admin/venuesettings/datafield')->with('success', 'Datafield successfully created');

    }

    /**
     * Show the specified resource.
     */
    public function show()
    {

        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Data Field";
        $pageroot = "Venue";

        $venuedatafield = VenueDataField::where('delete_status',0)->paginate(15);
        return view('venue::venuedatafield.list',compact('pagetitle','pageroot','username','venuedatafield'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue Data Field";
        $pageroot = "Venue";
        $venuedatafield = VenueDataField::where('id',$id)->first();
        return view('venue::venuedatafield.edit',compact('pagetitle','pageroot','username','venuedatafield'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

         $id = $request->id;
         $datafieldid = $id;
         $datafield = VenueDataField::find($id);
         $datafield->datafieldtype  = $request->datafieldtype;
         $datafield->datafieldname  = $request->datafieldname;
         $datafield->datafieldnametype  = $request->datafieldnametype;
      
         $datafield->status = 'Active';
         $datafield->delete_status = 0;
         $datafield->save();

         if($datafield->datafieldtype != 'Text' && $datafield->datafieldtype != 'Textarea')
         {
            $optionid = $request->optionid;
            $optionname = $request->optionname;

            for($i=0;$i<count($optionid);$i++)
            {
               
                $datafieldvalue = VenueDataFieldDetails::find($optionid[$i]);
                $datafieldvalue->datafieldid = $datafieldid;
                $datafieldvalue->optionname = $request->optionname[$i];
                $datafieldvalue->status = 'Active';
                $datafieldvalue->delete_status = 0;
                $datafieldvalue->save();

              
            }

         }

        

         if($datafield->datafieldtype != 'Text' && $datafield->datafieldtype != 'Textarea')
         {
            $optionnamenew = $request->optionnamenew;
            for($i=0;$i<count($optionnamenew);$i++)
            {
                $datafieldnewvalue = new VenueDataFieldDetails;
                $datafieldnewvalue->datafieldid = $datafieldid;
                $datafieldnewvalue->optionname = $request->optionnamenew[$i];
                $datafieldnewvalue->status = 'Active';
                $datafieldnewvalue->delete_status = 0;
                $datafieldnewvalue->save();
            }
         }

         return redirect('admin/venuesettings/datafield')->with('success', 'Datafield modification successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VenueDataField::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/venuesettings/datafield')->with('success', 'Datafield details successfully deleted');
    }



     public function updatestatus($id) {
    
        $venuetype = VenueDataField::where('id', '=', $id)->select('status')->first();
        $status = $venuetype->status;
        $venuetypestatus = "Active";
        if($status == "Active") {
            $venuetypestatus = "Inactive";
        }
        VenueDataField::where('id', '=', $id)->update(['status' => $venuetypestatus]);
        return redirect('admin/venuesettings/datafield')->with('success', 'Datafield status successfully updated');
    }

}
