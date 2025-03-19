<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Settings\Models\EventChecklistAssignments;
use Illuminate\Support\Facades\Validator;
use Modules\Settings\Models\ChecklistItems;
use Modules\Settings\Models\ChecklistCategory;
use Illuminate\Support\Facades\Session;
use App\Models\OccasionType;

class EventChecklistAssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Event Checklist";
        $eventChecklists = EventChecklistAssignments::where('delete_status', '0')->paginate(20);  
        return view('settings::eventchecklist.index', compact('pagetitle', 'pageroot', 'eventChecklists', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Settings";
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Event Checklist";
        $categories = ChecklistCategory::where('delete_status', '0')->get();
        $occasions = OccasionType::where('delete_status', '0')->get();
        return view('settings::eventchecklist.create', compact('pagetitle', 'pageroot', 'username','categories','occasions'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:checklistcategories,id',
            'occasion_id' => 'required|exists:occasion_types,id',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $eventChecklistAssignment = new EventChecklistAssignments();
            $eventChecklistAssignment->category_id = $request->category_id;
            $eventChecklistAssignment->occasion_id = $request->occasion_id;
            $eventChecklistAssignment->status = 'Active';
            $eventChecklistAssignment->delete_status = 0;
            $eventChecklistAssignment->save();

            return redirect()->route('admin.eventchecklist.index')->with('success', 'Event checklist assignment added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventchecklist.index')->with('error', $e->getMessage());
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
        $pagetitle = "Edit Event Checklist";
        $categories = ChecklistCategory::where('delete_status', '0')->get();
        $occasions = OccasionType::where('delete_status', '0')->get();
        $eventChecklist = EventChecklistAssignments::find($id);
        $checklistitems = ChecklistItems::where('category_id', $eventChecklist->category_id)->get();
        if (!$eventChecklist) {
            return redirect()->route('admin.eventchecklist.index')->with('error', 'Event Checklist Assignment not found.');
        }
        return view('settings::eventchecklist.edit', compact('pagetitle', 'pageroot', 'username', 'categories', 'occasions', 'eventChecklist','checklistitems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:checklistcategories,id',
            'occasion_id' => 'required|exists:occasion_types,id',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $eventChecklistAssignment = EventChecklistAssignments::find($id);
            if (!$eventChecklistAssignment) {
            return redirect()->route('admin.eventchecklist.index')->with('error', 'Event Checklist Assignment not found.');
            }

            $eventChecklistAssignment->category_id = $request->category_id;
            $eventChecklistAssignment->occasion_id = $request->occasion_id;
            $eventChecklistAssignment->status = 'Active';
            $eventChecklistAssignment->delete_status = 0;
            $eventChecklistAssignment->save();

            return redirect()->route('admin.eventchecklist.index')->with('success', 'Event checklist assignment updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventchecklist.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $eventChecklistAssignment = EventChecklistAssignments::find($id);
            $eventChecklistAssignment->delete_status = 1;
            $eventChecklistAssignment->save();
            return redirect()->route('admin.eventchecklist.index')->with('success', 'Event checklist assignment deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventchecklist.index')->with('error', $e->getMessage());
        }
    }

    public function updatestatus($id)
    {
        $eventChecklistAssignment = EventChecklistAssignments::find($id);
        if (!$eventChecklistAssignment) {
            return redirect()->route('admin.eventchecklist.index')->with('error', 'Event Checklist Assignment not found.');
        }
        $eventChecklistAssignment->status = ($eventChecklistAssignment->status === 'Active') ? 'Inactive' : 'Active';
        $eventChecklistAssignment->save();
        return redirect()->route('admin.eventchecklist.index')->with('success', 'Event Checklist Assignment status successfully updated.');
    }
}
