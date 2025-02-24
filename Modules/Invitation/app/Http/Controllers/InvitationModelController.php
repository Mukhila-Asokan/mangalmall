<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $pagetitle = "Design and Style";
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
        $pagetitle = "Design and Style";
        return view('invitation::invitationmodel.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modelname' => 'required|string|max:255|unique:invitationmodel',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $invitationmodel = new InvitationModel;
            $invitationmodel->modelname = $request->input('modelname');
            $invitationmodel->status = 'Active';
            $invitationmodel->delete_status = 0;
            $invitationmodel->save();

            return redirect('admin/invitation/invitationmodel')->with('success', 'Invitation Model successfully created');
        } catch (\Exception $e) {
            return redirect('admin/invitation/invitationmodel')->with('error', $e->getMessage());
        }

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
        
        $validator = Validator::make($request->all(), [
            'modelname' => 'required|string|max:255|unique:invitationmodel,modelname,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $invitationmodel = InvitationModel::find($request->id);
            $invitationmodel->modelname = $request->input('modelname');
            $invitationmodel->status = 'Active';
            $invitationmodel->delete_status = 0;
            $invitationmodel->save();

            return redirect('admin/invitation/invitationmodel')->with('success', 'Invitation Model successfully updated');
        } catch (\Exception $e) {
            return redirect('admin/invitation/invitationmodel')->with('error', $e->getMessage());
        }

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
