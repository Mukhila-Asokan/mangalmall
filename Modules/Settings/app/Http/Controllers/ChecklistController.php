<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OccasionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Validator;
use Modules\Settings\Models\Checklist;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Checklist";
        $checklists = Checklist::with('occasion')
        ->orderBy('occasion_id')
        ->orderBy('maintitle')
        ->orderBy('name')
        ->get()
        ->groupBy('occasion_id');
        return view('settings::checklist.index', compact('pagetitle', 'pageroot', 'checklists', 'username'));      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Checklist";
        $occasions = OccasionType::where('delete_status', '0')->get();
        $maintitles = Checklist::where('delete_status', '0')->where('maintitle','0')->get();
        return view('settings::checklist.create', compact('pagetitle', 'pageroot', 'occasions', 'username','maintitles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:checklists',
            'occasion' => 'required|exists:occasion_types,id'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $checklist = new Checklist();
            $checklist->name = $request->name;
            $checklist->maintitle = $request->maintitle;
            $checklist->occasion_id = $request->occasion;
            $checklist->status = 'Active';
            $checklist->delete_status = 0;
            $checklist->save();

            return redirect()->route('admin.checklist')->with('success', 'Checklist added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.checklist')->with('error', $e->getMessage());
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
        return view('settings::edit');
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
