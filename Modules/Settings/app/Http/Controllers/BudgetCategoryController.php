<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Settings\Models\BudgetCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class BudgetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Budget Category";
        $category = BudgetCategory::where('delete_status', '0')->paginate(20);  
        return view('settings::budgetcat.index', compact('pagetitle', 'pageroot', 'category', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Budget Category";
        return view('settings::budgetcat.create', compact('pagetitle', 'pageroot', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:budgetcategories',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $budgetCategory = new BudgetCategory();
            $budgetCategory->name = $request->name;
            $budgetCategory->icon = $request->icon ?? 'fa-face-grin-hearts';
            $budgetCategory->color = $request->color ?? '#cccccc';
            $budgetCategory->status = 'Active';
            $budgetCategory->delete_status = 0;
            $budgetCategory->save();

            return redirect()->route('admin.budgetcat.index')->with('success', 'Budget category added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.budgetcat.index')->with('error', $e->getMessage());
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
        $pagetitle = "Budget Category";
        $budgetCategory = BudgetCategory::findOrFail($id);
        return view('settings::budgetcat.edit', compact('pagetitle', 'pageroot', 'username', 'budgetCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:budgetcategories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $budgetCategory = BudgetCategory::findOrFail($id);
            $budgetCategory->name = $request->name;
            $budgetCategory->icon = $request->icon ?? 'fa-face-grin-hearts';
            $budgetCategory->color = $request->color ?? '#cccccc';
            $budgetCategory->status = 'Active';
            $budgetCategory->delete_status = 0;
            $budgetCategory->save();

            return redirect()->route('admin.budgetcat.index')->with('success', 'Budget category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.budgetcat.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $budgetCategory = BudgetCategory::find($id);
            $budgetCategory->delete_status = 1;
            $budgetCategory->save();
            return redirect()->route('admin.budgetcat.index')->with('success', 'Budget category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.budgetcat.index')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $budgetCategory = BudgetCategory::find($id);
        if (!$budgetCategory) {
            return redirect()->route('admin.budgetcat.index')->with('error', 'Budget Category not found.');
        }
        $budgetCategory->status = ($budgetCategory->status === 'Active') ? 'Inactive' : 'Active';
        $budgetCategory->save();
        return redirect()->route('admin.budgetcat.index')->with('success', 'Budget Category status successfully updated.');
    }
}
