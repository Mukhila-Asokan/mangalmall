<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\InvitationSilhoutte;
use Illuminate\Support\Facades\Validator;
use Session;    

class InvitationSilhoutteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Silhoutte";
        $invitationsilhoutte = InvitationSilhoutte::where('delete_status', '0')->paginate(10);
        return view('invitation::silhoutte.index', compact('pagetitle', 'pageroot', 'invitationsilhoutte', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Silhoutte";
        return view('invitation::silhoutte.create', compact('pagetitle', 'pageroot', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'silhouttename' => 'required|unique:invitationsilhoutte'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $invitationsilhoutte = new InvitationSilhoutte();
            $invitationsilhoutte->silhouttename = $request->silhouttename;
            $invitationsilhoutte->status = 'Active';
            $invitationsilhoutte->delete_status = 0;
            $invitationsilhoutte->save();
            return redirect('admin/invitation/silhouette')->with('success', 'Invitation Silhoutte added successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/silhouette')->with('error', $e->getMessage());
        }

        
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Edit Invitation Silhoutte";
        $silhouette = InvitationSilhoutte::findOrFail($id);
        return view('invitation::silhoutte.edit', compact('pagetitle', 'pageroot', 'silhouette', 'username'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'silhouttename' => 'required|unique:invitationsilhoutte,silhouttename,' . $id
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $silhoutte = InvitationSilhoutte::findOrFail($id);
            $silhoutte->silhouttename = $request->silhouttename;
            $silhoutte->status = 'Active';
            $silhoutte->delete_status = 0;
            $silhoutte->save();
            return redirect('admin/invitation/silhouette')->with('success', 'Invitation Silhoutte updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/silhouette')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $invitationsilhoutte = InvitationSilhoutte::find($id);
            $invitationsilhoutte->delete_status = 1;
            $invitationsilhoutte->save();
            return redirect('admin/invitation/silhouette')->with('success', 'Invitation Silhoutte deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/silhouette')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $invitationsilhoutte = InvitationSilhoutte::find($id);
        if (!$invitationsilhoutte) {
            return redirect('admin/invitation/silhouette')->with('error', 'Invitation Silhoutte not found.');
        }
        $invitationsilhoutte->status = ($invitationsilhoutte->status === 'Active') ? 'Inactive' : 'Active';
        $invitationsilhoutte->save();

        return redirect('admin/invitation/silhouette')->with('success', 'Invitation Silhoutte status successfully updated.');
    }
}
