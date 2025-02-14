<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\InvitationColor;
use Illuminate\Support\Facades\Validator;
use Session;

class InvitationColorController extends Controller
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
        $invitationcolor = InvitationColor::where('delete_status','0')->paginate(10);
        return view('invitation::invitationcolor.index', compact('pagetitle','pageroot','invitationcolor','username'));
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
        return view('invitation::invitationcolor.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'colorname' => 'required|string|max:255|unique:invitationcolor',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        try {
            $invitationColor = new InvitationColor();
            $invitationColor->colorname = $request->input('colorname');
            $invitationColor->status = 'Active';
            $invitationColor->delete_status = 0;
            $invitationColor->save();
            return redirect('admin/invitation/invitationcolor')->with('success', 'Invitation color created successfully.');  
        } catch (\Exception $e) {     
            return redirect('admin/invitation/invitationcolor')->with('error', $e->getMessage());  
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
        $pagetitle = "Invitation Size";
        $color = InvitationColor::where('id',$id)->first();
        return view('invitation::invitationcolor.edit',compact('pagetitle','pageroot','username','color'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'colorname' => 'required|string|max:255|unique:invitationcolor,colorname,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $invitationColor = InvitationColor::find($id);
            if (!$invitationColor) {
                return redirect('admin/invitation/invitationcolor')->with('error', 'Invitation color not found.');
            }
            $invitationColor->colorname = $request->input('colorname');
            $invitationColor->save();
            return redirect('admin/invitation/invitationcolor')->with('success', 'Invitation color updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/invitationcolor')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $color = InvitationColor::find($id);
            $color->delete_status = 1;
            $color->save();
            return redirect('admin/invitation/invitationcolor')->with('success', 'Invitation Color deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/invitationcolor')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $invitationcolor = InvitationColor::find($id);
        if (!$invitationcolor) {
            return redirect('admin/invitation/invitationcolor')->with('error', 'Invitation Color not found.');
        }
        $invitationcolor->status = ($invitationcolor->status === 'Active') ? 'Inactive' : 'Active';
        $invitationcolor->save();

        return redirect('admin/invitation/invitationcolor')->with('success', 'Invitation Color status successfully updated.');
    }
}
