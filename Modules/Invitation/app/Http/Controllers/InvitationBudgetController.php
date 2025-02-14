<?php

namespace Modules\Invitation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invitation\Models\InvitationBudget;
use Illuminate\Support\Facades\Validator;
use Session;    

class InvitationBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Invitation";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Budget";
        $invitationbudget = InvitationBudget::where('delete_status', '0')->paginate(10);
        return view('invitation::invitationbudget.index', compact('pagetitle', 'pageroot', 'invitationbudget', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Invitaion";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Invitation Budget";
        return view('invitation::invitationbudget.create',compact('pagetitle', 'pageroot', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'budgetname' => 'required|unique:invitationbudget'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $invitationbudget = new InvitationBudget();
            $invitationbudget->budgetname = $request->budgetname;
            $invitationbudget->status = 'Active';
            $invitationbudget->delete_status = 0;
            $invitationbudget->save();
            return redirect('admin/invitation/budget')->with('success', 'Invitation Budget added successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/budget')->with('error', $e->getMessage());
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
        $pagetitle = "Edit Invitation Budget";
        $budget  = InvitationBudget::findOrFail($id);
        return view('invitation::invitationbudget.edit', compact('pagetitle', 'pageroot', 'budget', 'username'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'budgetname' => 'required|unique:invitationbudget,budgetname,' . $id
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $invitationbudget = InvitationBudget::findOrFail($id);
            $invitationbudget->budgetname = $request->budgetname;
            $invitationbudget->status = 'Active';
            $invitationbudget->delete_status = 0;
            $invitationbudget->save();
            return redirect('admin/invitation/budget')->with('success', 'Invitation Budget updated successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/budget')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $invitationbudget = InvitationBudget::find($id);
            $invitationbudget->delete_status = 1;
            $invitationbudget->save();
            return redirect('admin/invitation/budget')->with('success', 'Invitation Budget deleted successfully.');
        } catch (\Exception $e) {
            return redirect('admin/invitation/budget')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $invitationbudget = InvitationBudget::find($id);
        if (!$invitationbudget) {
            return redirect('admin/invitation/budget')->with('error', 'Invitation Budget not found.');
        }
        $invitationbudget->status = ($invitationbudget->status === 'Active') ? 'Inactive' : 'Active';
        $invitationbudget->save();

        return redirect('admin/invitation/budget')->with('success', 'Invitation Budget status successfully updated.');
    }
}
