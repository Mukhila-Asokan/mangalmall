<?php

namespace App\Http\Controllers;

use App\Models\UserOccasion;
use App\Http\Requests\StoreUserOccasionRequest;
use App\Http\Requests\UpdateUserOccasionRequest;
Use App\Models\OccasionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Modules\Venue\Models\Area;
use Illuminate\Support\Facades\Validator;

Use session;
use DB;
class UserOccasionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
     
        $userid = Auth::user()->id;  
        $occasiontype = OccasionType::where('delete_status','0')->get();
        $useroccasion = UserOccasion::where('userid',$userid)->get();
        $areaname = Area::select("areaname")->groupBy('Areaname')->get();
        return view('occasion',compact('occasiontype','useroccasion','userid','areaname'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required|integer',
            'occasiontype' => 'required',
            'occasion_place' => 'required',
            'occasiondate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
            ->withErrors($validator)
            ->withInput();
        }

        try {
            $occasion = new UserOccasion;
            $occasion->userid = $request->userid;
            $occasion->occasiontypeid = $request->occasiontype;
            $occasion->occasion_place = $request->occasion_place;
            $occasion->notes = $request->message ?? '-';
            $occasion->occasiondate = $request->occasiondate;
            $occasion->status = 'Active';
            $occasion->delete_status = 0;
            $occasion->save();  

            return redirect('home/occasion')->with('success', 'Occasion Type successfully created');
        } catch (\Exception $e) {
            return redirect('home/occasion')->with('error', 'Failed to create Occasion Type: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserOccasion $userOccasion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $occasion = UserOccasion::where('id',$request->id)->first();
        return response()->json($occasion, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required|integer',
            'occasiontype' => 'required',
            'occasion_place' => 'required',
            'occasiondate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $occasion = UserOccasion::findOrFail($id);
            $occasion->userid = $request->userid;
            $occasion->occasiontypeid = $request->occasiontype;
            $occasion->occasion_place = $request->occasion_place;
            $occasion->notes = $request->message ?? '-';
            $occasion->occasiondate = $request->occasiondate;
            $occasion->status = 'Active';
            $occasion->delete_status = 0;
            $occasion->save();

            return redirect('home/occasion')->with('success', 'Occasion Type successfully updated');
        } catch (\Exception $e) {
            return redirect('home/occasion')->with('error', 'Failed to update Occasion Type: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserOccasion $userOccasion)
    {
        //
    }
}
