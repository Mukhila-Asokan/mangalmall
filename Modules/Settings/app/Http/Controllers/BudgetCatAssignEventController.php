<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OccasionType;
use Illuminate\Http\Request;
use Modules\Settings\Models\BudgetCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Settings\Models\BudgetItems;
use Modules\Settings\Models\BudgetCatAssignEvent;

class BudgetCatAssignEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Budget Category Assign Event";
        $eventBudgets = BudgetCatAssignEvent::where('delete_status', '0')->paginate(20);  
        return view('settings::eventbudget.index', compact('pagetitle', 'pageroot', 'eventBudgets', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Budget Category Assign Event";
        $categories = BudgetCategory::where('delete_status', '0')->get();
        $budgetItems = BudgetItems::where('delete_status', '0')->get();
        $occasions = OccasionType::where('delete_status', '0')->get();  
        return view('settings::eventbudget.create', compact('pagetitle', 'pageroot', 'username', 'categories', 'budgetItems','occasions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:budgetcategories,id',
            'occasion_id' => 'required|exists:occasion_types,id',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $eventBudgetAssignment = new BudgetCatAssignEvent();
            $eventBudgetAssignment->category_id = $request->category_id;
            $eventBudgetAssignment->occasion_id = $request->occasion_id;
            $eventBudgetAssignment->status = 'Active';
            $eventBudgetAssignment->delete_status = 0;
            $eventBudgetAssignment->save();

            return redirect()->route('admin.eventbudget.index')->with('success', 'Event budget assignment added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventbudget.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Budget Category Assign Event";
        $categories = BudgetCategory::where('delete_status', '0')->get();
        $budgetItems = BudgetItems::where('delete_status', '0')->get();
        $occasions = OccasionType::where('delete_status', '0')->get();
        $eventBudgetAssignment = BudgetCatAssignEvent::findOrFail($id);
        return view('settings::eventbudget.edit', compact('pagetitle', 'pageroot', 'username', 'categories', 'budgetItems', 'occasions', 'eventBudgetAssignment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:budgetcategories,id',
            'occasion_id' => 'required|exists:occasion_types,id',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $eventBudgetAssignment = BudgetCatAssignEvent::findOrFail($id);
            $eventBudgetAssignment->category_id = $request->category_id;
            $eventBudgetAssignment->occasion_id = $request->occasion_id;
            $eventBudgetAssignment->status = 'Active';
            $eventBudgetAssignment->delete_status = 0;
            $eventBudgetAssignment->save();

            return redirect()->route('admin.eventbudget.index')->with('success', 'Event budget assignment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventbudget.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $eventBudgetAssignment = BudgetCatAssignEvent::find($id);
            $eventBudgetAssignment->delete_status = 1;
            $eventBudgetAssignment->save();
            return redirect()->route('admin.eventbudget.index')->with('success', 'Event budget assignment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventbudget.index')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $eventBudgetAssignment = BudgetCatAssignEvent::find($id);
        if (!$eventBudgetAssignment) {
            return redirect()->route('admin.eventbudget.index')->with('error', 'Event budget assignment not found.');
        }
        $eventBudgetAssignment->status = ($eventBudgetAssignment->status === 'Active') ? 'Inactive' : 'Active';
        $eventBudgetAssignment->save();
        return redirect()->route('admin.eventbudget.index')->with('success', 'Event budget assignment status successfully updated.');
    }
}
