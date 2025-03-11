<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Modules\Venue\Models\Menu;
use Illuminate\Support\Facades\Schema;
class DeletedRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagetitle = "Deleted Records";
        $pageroot = "Venue";
        $pageurl = route('venue');
        $deletedMenus = Menu::where('delete_status', 0)->paginate(20);
        return view('venue::deletedrecords.index', compact('pagetitle', 'pageroot', 'deletedMenus','pageurl'));      
    }

    public function deletedview($id)
    {
        $pagetitle = "Deleted Records";
        $pageroot = "Venue";
        $deletedRecords = collect(); // Initialize an empty collection
        $error = null; // Initialize error message

        $deletedMenus = Menu::where('id', $id)->first();
      
        if ($deletedMenus && Schema::hasTable((new $deletedMenus->modelname)->getTable())) {
            
            $modelClass = $deletedMenus->modelname;
           
            if (class_exists($modelClass)) {                
                $deletedRecords = $modelClass::where('delete_status', '1')->paginate(20);
                $tableName = (new $modelClass)->getTable();               
                $columns = Schema::getColumnListing($tableName);
            } else {
                $columns = [];
                $deletedRecords = collect();
                $error = "Table does not exist.";             
            }
        }  else {
            $columns = [];
            $deletedRecords = collect();
            $error = "Model or table not found.";
        }

        return view('venue::deletedrecords.show', compact('pagetitle', 'pageroot', 'deletedRecords', 'deletedMenus','columns'))
            ->with('error', $error);
    }

    public function bulkAction(Request $request)
    {
        //menuid
        $deletedMenus = Menu::where('id', $request->menuid)->first();
        $modelClass = $deletedMenus->modelname;
        $selectedIds = $request->input('record_ids', []);

        if (empty($selectedIds)) {
            return back()->with('error', 'No records selected.');
        }

        // Example: Restore or Permanently Delete based on user action
        $action = $request->input('action'); // Example: 'restore' or 'delete'

        if ($action === 'restore') {
            $modelClass::whereIn('id', $selectedIds)->update(['delete_status' => '0']);
            return back()->with('success', 'Selected records have been restored.');
        } elseif ($action === 'delete') {
            $modelClass::whereIn('id', $selectedIds)->delete();
            return back()->with('success', 'Selected records have been permanently deleted.');
        }

        return back()->with('error', 'Invalid action.');
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venue::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('venue::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('venue::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
