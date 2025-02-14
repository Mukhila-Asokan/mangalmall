<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Invitation\Models\InvitationPrintingMethod;
use Session;

class InvitationPrintingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Invitaion";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Printing Method";
        $printingmethod = InvitationPrintingMethod::where('delete_status','0')->paginate(10);
        return view('invitation::printingmethod.index',compact('pageroot','username','pagetitle','printingmethod'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $pageroot = "Invitaion";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Printing Method";
        return view('invitation::printingmethod.create',compact('pagetitle','pageroot','username'));       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'printingmethod' => 'required|string|max:255|unique:invitationprintingmethod',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        try {
            $invprintingmethod = new InvitationPrintingMethod();
            $invprintingmethod->printingmethod = $request->input('printingmethod');
            $invprintingmethod->status = 'Active';
            $invprintingmethod->delete_status = 0;
            $invprintingmethod->save();
            return redirect('admin/invitation/printingmethod')->with('success', 'Invitation Printing Method created successfully.');  
        } catch (\Exception $e) {     
            return redirect('admin/invitation/printingmethod')->with('error', $e->getMessage());  
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
        $pagetitle = "Printing Method";
        $printingMethod = InvitationPrintingMethod::find($id);
        if (!$printingMethod) {
            return redirect('admin/invitation/printingmethod')->with('error', 'Invitation Printing Method not found.');
        }
        return view('invitation::printingmethod.edit', compact('pagetitle', 'pageroot', 'username', 'printingMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'printingmethod' => 'required|string|max:255|unique:invitationprintingmethod,printingmethod,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $invprintingmethod = InvitationPrintingMethod::find($id);
            if (!$invprintingmethod) {
                return redirect('admin/invitation/printingmethod')->with('error', 'Invitation Printing Method not found.');
            }
            $invprintingmethod->printingmethod = $request->input('printingmethod');
            $invprintingmethod->save();
            return redirect('admin/invitation/printingmethod')->with('success', 'Invitation Printing Method updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/printingmethod')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $method = InvitationPrintingMethod::find($id);
            $method->delete_status = 1;
            $method->save();
            return redirect('admin/invitation/printingmethod')->with('success', 'Invitation Printing Method deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/printingmethod')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $method = InvitationPrintingMethod::find($id);
        if (!$method) {
            return redirect('admin/invitation/printingmethod')->with('error', 'Invitation Printing Method not found.');
        }
        $method->status = ($method->status === 'Active') ? 'Inactive' : 'Active';
        $method->save();

        return redirect('admin/invitation/printingmethod')->with('success', 'Invitation Printing Method status successfully updated.');
    }
}
