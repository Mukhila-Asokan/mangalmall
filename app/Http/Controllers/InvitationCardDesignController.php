<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\OccasionType;

use Intervention\Image\ImageManager;
use Modules\Invitation\Models\CardTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Session;

class InvitationCardDesignController extends Controller
{
    public function index(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->withErrors(['error' => 'User is not authenticated']);
    }

    // Fetch occasion types
    $occasiontype = OccasionType::where('delete_status', '0')->get();

    // Fetch card templates with filtering
    $query = CardTemplate::selectRaw('
    MAX(id) as id,
    templatename,
    MAX(templateurl) as templateurl,
    MAX(templateimage) as templateimage,
    MAX(occasionid) as occasionid,
    MAX(status) as status,
    MAX(created_at) as created_at,
    MAX(updated_at) as updated_at
')
->where('delete_status', '0')
->groupBy('templatename')
->orderByDesc('id');

    $perPage = 12;
    $cardTemplates = $query->paginate($perPage)->appends(request()->query()); 
   
    
    return Inertia::render('InvitationCardDesign', [
        'occasiontype' => $occasiontype ?? [],
        'cardTemplates' => $cardTemplates,
        'filters' => $request->all(),
    ]);
}

public function getCardTemplates(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'User is not authenticated'], 401);
    }

    try {
        // Fetch occasion types
        $occasiontype = OccasionType::where('delete_status', '0')->get();

        // Fetch card templates with filtering
        $query = CardTemplate::where('delete_status', '0');

        if ($request->filled('occasionType')) {
            $query->where('occasionid', $request->occasionType);
        }

        if ($request->filled('sortBy')) {
            if ($request->sortBy === 'new') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sortBy === 'popularity') {
                $query->orderBy('popularity_score', 'desc');
            }
        }

        $cardTemplates = $query->orderBy('id', 'desc')->paginate(12)->appends($request->query());

        return response()->json([
            'occasiontype' => $occasiontype ?? [],
            'invitationCards' => $cardTemplates,
            'filters' => $request->all(),
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }

}
public function edit($id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->withErrors(['error' => 'User is not authenticated']);
    }

    $cardTemplate = CardTemplate::find($id);

    if (!$cardTemplate) {
        return redirect()->route('invitation.card.design')->withErrors(['error' => 'Card template not found']);
    }

    return Inertia::render('InvitationCardDesignEdit', [
        'cardTemplate' => $cardTemplate,
    ]);
}



}
