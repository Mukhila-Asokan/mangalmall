<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Invitation\Models\InvitationPrintingMaterial;
use Session;

class InvitationPrintingMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Printing Material";
        $printingmaterial = InvitationPrintingMaterial::where('delete_status', '0')->paginate(10);
        return view('invitation::printingmaterial.index', compact('pageroot', 'username', 'pagetitle', 'printingmaterial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Printing Material";
        return view('invitation::printingmaterial.create', compact('pagetitle', 'pageroot', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'printingmaterialname' => 'required|string|max:255|unique:invitationprintingmaterial',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $invprintingmaterial = new InvitationPrintingMaterial();
            $invprintingmaterial->printingmaterialname = $request->input('printingmaterialname');
            $invprintingmaterial->status = 'Active';
            $invprintingmaterial->delete_status = 0;
            $invprintingmaterial->save();
            return redirect('admin/invitation/printingmaterial')->with('success', 'Invitation Printing Material created successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/printingmaterial')->with('error', $e->getMessage());
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
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Printing Material";
        $printingMaterial = InvitationPrintingMaterial::find($id);
        if (!$printingMaterial) {
            return redirect('admin/invitation/printingmaterial')->with('error', 'Invitation Printing Material not found.');
        }
        return view('invitation::printingmaterial.edit', compact('pagetitle', 'pageroot', 'username', 'printingMaterial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'printingmaterialname' => 'required|string|max:255|unique:invitationprintingmaterial,printingmaterialname,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $invprintingmaterial = InvitationPrintingMaterial::find($id);
            if (!$invprintingmaterial) {
            return redirect('admin/invitation/printingmaterial')->with('error', 'Invitation Printing Material not found.');
            }
            $invprintingmaterial->printingmaterialname = $request->input('printingmaterialname');
            $invprintingmaterial->status = 'Active';
            $invprintingmaterial->delete_status = 0;
            $invprintingmaterial->save();
            return redirect('admin/invitation/printingmaterial')->with('success', 'Invitation Printing Material updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/printingmaterial')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $invprintingmaterial = InvitationPrintingMaterial::find($id);
            if (!$invprintingmaterial) {
            return redirect('admin/invitation/printingmaterial')->with('error', 'Invitation Printing Material not found.');
            }
            $invprintingmaterial->delete_status = 1;
            $invprintingmaterial->save();
            return redirect('admin/invitation/printingmaterial')->with('success', 'Invitation Printing Material deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/printingmaterial')->with('error', $e->getMessage());
        }
    }


    public function updatestatus($id)
    {
        $printingMaterial = InvitationPrintingMaterial::find($id);
        if (!$printingMaterial) {
            return redirect('admin/invitation/printingmaterial')->with('error', 'Invitation Printing Material not found.');
        }
        $printingMaterial->status = ($printingMaterial->status === 'Active') ? 'Inactive' : 'Active';
        $printingMaterial->save();

        return redirect('admin/invitation/printingmaterial')->with('success', 'Invitation Printing Material status successfully updated.');
    }
}
