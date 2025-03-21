<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Settings\Models\BudgetCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Settings\Models\BudgetItems;

class BudgetItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Budget Items";
        $budgetItems = BudgetItems::where('delete_status', '0')->paginate(20);  
        return view('settings::budgetitems.index', compact('pagetitle', 'pageroot', 'budgetItems', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Budget Items";
        $budgetCategories = BudgetCategory::where('delete_status', '0')->get();
        return view('settings::budgetitems.create', compact('pagetitle', 'pageroot', 'username', 'budgetCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'budget_category_id' => 'required',            
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $budgetItems = new BudgetItems();
            $budgetItems->name = $request->name;
            $budgetItems->budget_category_id = $request->budget_category_id;          
            $budgetItems->status = 'Active';  
            $budgetItems->delete_status = 0;
            $budgetItems->save();

            return redirect()->route('admin.budgetitems.index')->with('success', 'Budget Items added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.budgetitems.index')->with('error', $e->getMessage());
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
        $pagetitle = "Edit Budget Item";
        $budgetCategories = BudgetCategory::where('delete_status', '0')->get();
        $budgetItem = BudgetItems::findOrFail($id);
        return view('settings::budgetitems.edit', compact('pagetitle', 'pageroot', 'username', 'budgetCategories', 'budgetItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'budget_category_id' => 'required',            
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $budgetItems = BudgetItems::findOrFail($id);
            $budgetItems->name = $request->name;
            $budgetItems->budget_category_id = $request->budget_category_id;          
            $budgetItems->status = 'Active';  
            $budgetItems->delete_status = 0;
            $budgetItems->save();

            return redirect()->route('admin.budgetitems.index')->with('success', 'Budget Items updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.budgetitems.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $budgetItem = BudgetItems::find($id);
            $budgetItem->delete_status = 1;
            $budgetItem->save();
            return redirect()->route('admin.budgetitems.index')->with('success', 'Budget item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.budgetitems.index')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $budgetItem = BudgetItems::find($id);
        if (!$budgetItem) {
            return redirect()->route('admin.budgetitems.index')->with('error', 'Budget Item not found.');
        }
        $budgetItem->status = ($budgetItem->status === 'Active') ? 'Inactive' : 'Active';
        $budgetItem->save();
        return redirect()->route('admin.budgetitems.index')->with('success', 'Budget Item status successfully updated.');
    }
    public function getitems(Request $request)
    {
        $categoryId = $request->category_id;

        $items = BudgetItems::where('budget_category_id', $categoryId)->where('delete_status', '0')->get();

        if ($items->count() > 0) {
            return response()->json([
                'success' => true,
                'items' => $items
            ]);
        } else {
            return response()->json([
                'success' => true,
                'items' => []
            ]);
        }
    }

}
