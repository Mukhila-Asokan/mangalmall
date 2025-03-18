<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Settings\Models\ChecklistItems;
use Modules\Settings\Models\ChecklistCategory;

class ChecklistItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Checklist Items";
        $items = ChecklistItems::where('delete_status', '0')->paginate(20);  
        return view('settings::checklistitems.index',compact('pagetitle', 'pageroot', 'items', 'username'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Checklist Items";
        $checklist = ChecklistCategory::where('delete_status', '0')->get();
        return view('settings::checklistitems.create',compact('pagetitle', 'pageroot','username','checklist' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:checklistcategories,id',
            'item_name' => 'required|unique:category_checklist_items,item_name',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $checklistItem = new ChecklistItems();
            $checklistItem->category_id = $request->category_id;
            $checklistItem->item_name = $request->item_name;
            $checklistItem->status = 'Active';
            $checklistItem->delete_status = 0;
            $checklistItem->save();

            return redirect()->route('admin.checklistitems.index')->with('success', 'Checklist item added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.checklistitems.index')->with('error', $e->getMessage());
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
        $pagetitle = "Checklist Items";
        $checklist = ChecklistCategory::where('delete_status', '0')->get();
        $checklistItem = ChecklistItems::findOrFail($id);
        return view('settings::checklistitems.edit', compact('pagetitle', 'pageroot', 'username', 'checklist', 'checklistItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:checklistcategories,id',
            'item_name' => 'required|unique:category_checklist_items,item_name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $checklistItem = ChecklistItems::findOrFail($id);
            $checklistItem->category_id = $request->category_id;
            $checklistItem->item_name = $request->item_name;
            $checklistItem->status = 'Active';
            $checklistItem->delete_status = 0;
            $checklistItem->save();

            return redirect()->route('admin.checklistitems.index')->with('success', 'Checklist item updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.checklistitems.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $checklistItem = ChecklistItems::find($id);
            $checklistItem->delete_status = 1;
            $checklistItem->save();
            return redirect()->route('admin.checklistitems.index')->with('success', 'Checklist item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.checklistitems.index')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $checklistItem = ChecklistItems::find($id);
        if (!$checklistItem) {
            return redirect()->route('admin.checklistitems.index')->with('error', 'Checklist Item not found.');
        }
        $checklistItem->status = ($checklistItem->status === 'Active') ? 'Inactive' : 'Active';
        $checklistItem->save();
        return redirect()->route('admin.checklistitems.index')->with('success', 'Checklist Item status successfully updated.');
    }
    public function getitems(Request $request)
    {
        $categoryId = $request->category_id;

        $items = ChecklistItems::where('category_id', $categoryId)->where('delete_status','0')->get();
    
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
