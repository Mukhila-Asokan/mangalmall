<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOccasion;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Models\EventChecklistAssignments;
use Illuminate\Support\Facades\Validator;
use Modules\Settings\Models\ChecklistItems;
use Modules\Settings\Models\ChecklistCategory;
use App\Models\UserChecklist;

class UserChecklistController extends Controller
{
    public function create($id)
    {
        try {
            $userid = Auth::user()->id;
         
            $useroccasion = UserOccasion::where('userid', $userid)->where('occasiontypeid', $id)->first();
            $checklistcatIds = EventChecklistAssignments::where('occasion_id', $id)->pluck('category_id');

            $checklistitems = ChecklistItems::whereIn('category_id', $checklistcatIds)->get();
            // Group data by status
           
            foreach ($checklistitems as $checklistitem) {
            $existingChecklist = UserChecklist::where('name', $checklistitem->item_name)
                ->where('user_id', $userid)
                ->where('occasion_id', $id)
                ->first();
        
            if (!$existingChecklist) { // Prevent duplicates
                $usechecklist = new UserChecklist();
                $usechecklist->name = $checklistitem->item_name;
                $usechecklist->user_id = $userid;
                $usechecklist->occasion_id = $id;            
                $usechecklist->completed_status = 'not_started';
                $usechecklist->status = 'Active';
                $usechecklist->delete_status = 0;
                $usechecklist->save();
            }
            }
        
            $checklist = UserChecklist::where('user_id', $userid)
            ->where('occasion_id', $id)
            ->get()
            ->groupBy('completed_status');

            return view('eventplan.create', compact('useroccasion', 'checklistcatIds', 'checklistitems', 'checklist'));

        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Session expired, please log in again.');
        }
    }
    public function index()
    {
        echo "hai";
    }

    public function updateStatus(Request $request)
{
    $item = UserChecklist::find($request->id);
    if ($item) {       
      
        $item->completed_status = $request->status;
        $item->save();
        return response()->json(['success' => true]);
    }

    return response()->json(['error' => 'Checklist item not found'], 404);
}

public function store(Request $request)
{
    $request->validate([
        'item_name' => 'required|string|max:255',
        'occasion_id' => 'required|integer',
    ]);
    $userid = Auth::user()->id;
    $usechecklist = new UserChecklist();
    $usechecklist->name = $request->item_name;
    $usechecklist->user_id = $userid;
    $usechecklist->occasion_id = $request->occasion_id;
    $usechecklist->completed_status = 'not_started';
    $usechecklist->status = 'Active';
    $usechecklist->delete_status = 0;
    $usechecklist->save();

    return redirect()->back()->with('success', 'Checklist item added successfully!');
}

}
