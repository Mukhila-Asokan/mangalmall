<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\InvitationModel;
use Session;

class InvitationModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Model";
        $invitationmodel = InvitationModel::where('delete_status','0')->paginate(10);
        return view('invitation::invitationmodel.index', compact('pagetitle','pageroot','invitationmodel','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Model";
        return view('invitation::invitationmodel.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'modelname' => 'required|unique:invitationmodel'
         ]);

        $invitationmodel = new InvitationModel;
        $invitationmodel->modelname = $request->modelname;
        $invitationmodel->status = 'Active';
        $invitationmodel->delete_status = 0;
        $invitationmodel->save();  

         return redirect('admin/invitation/invitationmodel')->with('success', 'Invitation Model successfully created');

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('invitation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Home";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Model";
        $invitationmodel = InvitationModel::where('id',$id)->first();
       
        return view('invitation::invitationmodel.edit', compact('pagetitle','pageroot','username','invitationmodel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $id = $request->id;
        $request->validate([
            'modelname' => 'required|unique:invitationmodel,modelname,'.$id.'|max:255',
        ]);

         $invitationmodel = InvitationModel::find($id);
         $invitationmodel->modelname = $request->modelname;
         $invitationmodel->status = 'Active';
         $invitationmodel->delete_status = 0;
         $invitationmodel->save();  

        return redirect('admin/invitation/invitationmodel')->with('success', 'Invitation Model successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        InvitationModel::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/invitation/invitationmodel')->with('success', 'Invitation Model  successfully deleted');
    }

     public function updatestatus($id) {    
        $invitationmodel = InvitationModel::where('id', '=', $id)->select('status')->first();
        $status = $invitationmodel->status;
        $invitationmodelstatus = "Active";
        if($status == "Active") {
            $invitationmodelstatus = "Inactive";
        }
        InvitationModel::where('id', '=', $id)->update(['status' => $invitationmodelstatus]);
        return redirect('admin/invitation/invitationmodel')->with('success', 'Invitation Model  status successfully updated');
    }
}
