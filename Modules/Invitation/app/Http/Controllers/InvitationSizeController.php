<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\InvitationSize;
use Illuminate\Support\Facades\Validator;
use Session;

class InvitationSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Invitaion";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Size";
        $invitationsize = InvitationSize::where('delete_status','0')->paginate(10);
        return view('invitation::invitationsize.index', compact('pagetitle','pageroot','invitationsize','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Invitaion";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Size";
        return view('invitation::invitationsize.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sizename' => 'required|unique:invitationsize'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {           
                $invitationsize = new InvitationSize();
                $invitationsize->sizename = $request->sizename;
                $invitationsize->status = 'Active';
                $invitationsize->delete_status = 0;
                $invitationsize->save();
                return redirect('admin/invitation/invitationsize')->with('success', 'Invitation Size added successfully.');  
       
            } catch (\Exception $e) {     
            return redirect('admin/invitation/invitationsize')->with('error', $e->getMessage());  
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
        $pageroot = "Invitaion";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Edit Invitation Size";
        $invitationsize = InvitationSize::find($id);
        return view('invitation::invitationsize.edit', compact('pagetitle', 'pageroot', 'invitationsize', 'username'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sizename' => 'required|unique:invitationsize,sizename,' . $id
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $invitationsize = InvitationSize::find($id);
            $invitationsize->sizename = $request->sizename;
            $invitationsize->status = 'Active';
            $invitationsize->delete_status = 0;
            $invitationsize->save();
            return redirect('admin/invitation/invitationsize')->with('success', 'Invitation Size updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/invitationsize')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $invitationsize = InvitationSize::find($id);
            $invitationsize->delete_status = 1;
            $invitationsize->save();
            return redirect('admin/invitation/invitationsize')->with('success', 'Invitation Size deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/invitationsize')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $invitationsize = InvitationSize::find($id);
        if (!$invitationsize) {
            return redirect('admin/invitation/invitationsize')->with('error', 'Invitation Size not found.');
        }
        $invitationsize->status = ($invitationsize->status === 'Active') ? 'Inactive' : 'Active';
        $invitationsize->save();

        return redirect('admin/invitation/invitationsize')->with('success', 'Invitation Size status successfully updated.');
    }
}
