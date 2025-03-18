<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Settings\Models\ChecklistCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChecklistCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Checklist Category";
        $category = ChecklistCategory::where('delete_status', '0')->paginate(20);  
        return view('settings::checklistcat.index',compact('pagetitle', 'pageroot', 'category', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Checklist Category";
        return view('settings::checklistcat.create',compact('pagetitle', 'pageroot','username' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:checklistcategories',            
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $checklist = new ChecklistCategory();
            $checklist->name = $request->name;           
            $checklist->status = 'Active';
            $checklist->delete_status = 0;
            $checklist->save();

            return redirect()->route('admin.checklistcat.index')->with('success', 'Checklist category added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.checklistcat.index')->with('error', $e->getMessage());
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
        $pagetitle = "Edit Checklist Category";
        $checklistcat = ChecklistCategory::findOrFail($id);
        return view('settings::checklistcat.edit', compact('pagetitle', 'pageroot', 'username', 'checklistcat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:checklistcategories,name,' . $id
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {           
            $category = ChecklistCategory::findOrFail($id);
            $category->categoryname = $request->name;
            $category->status = $request->status ?? 'Active';
            $category->save();
            return redirect()->route('admin.checklistcat.index')->with('success', 'Checklist Category updated successfully.');           
        } catch (\Exception $e) {     
            return redirect()->route('admin.checklistcat.index')->with('error', $e->getMessage());  
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $checklist = ChecklistCategory::find($id);
            $checklist->delete_status = 1;
            $checklist->save();
            return redirect()->route('admin.checklistcat.index')->with('success', 'Checklist Category deleted successfully.'); 
        } catch (\Exception $e) {
            return redirect()->route('admin.checklistcat.index')->with('error', $e->getMessage());  
        }
    }

    public function updatestatus($id)
    {
        $checklist = ChecklistCategory::find($id);
        if (!$checklist) {
            return redirect()->route('admin.checklistcat.index')->with('error', 'Checklist Category not found.');            
        }
        $checklist->status = ($checklist->status === 'Active') ? 'Inactive' : 'Active';
        $checklist->save();
        return redirect()->route('admin.checklistcat.index')->with('success', 'Checklist Category status successfully updated.');     
    }

}
