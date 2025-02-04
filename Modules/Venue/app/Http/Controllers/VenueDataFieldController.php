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
    $datafield = VenueDataField::find($id);

    
    if (!$datafield) {
        return redirect()->back()->with('error', 'Datafield not found.');
    }

   
    $datafield->datafieldtype = $request->datafieldtype;
    $datafield->datafieldname = $request->datafieldname;
    $datafield->datafieldnametype = $request->datafieldnametype;
    $datafield->status = 'Active';
    $datafield->delete_status = 0;
    $datafield->save();

    
    if ($datafield->datafieldtype != 'Text' && $datafield->datafieldtype != 'Textarea') {

       
        if ($request->has('optionid') && is_array($request->optionid)) {
            foreach ($request->optionid as $key => $optionId) {
                $datafieldvalue = VenueDataFieldDetails::find($optionId);
                if ($datafieldvalue) {
                    $datafieldvalue->datafieldid = $id;
                    $datafieldvalue->optionname = $request->optionname[$key] ?? '';
                    $datafieldvalue->status = 'Active';
                    $datafieldvalue->delete_status = 0;
                    $datafieldvalue->save();
                }
            }
        }

     
        if ($request->has('optionnamenew') && is_array($request->optionnamenew)) {
            foreach ($request->optionnamenew as $newOption) {
                VenueDataFieldDetails::create([
                    'datafieldid' => $id,
                    'optionname' => $newOption,
                    'status' => 'Active',
                    'delete_status' => 0
                ]);
            }
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
