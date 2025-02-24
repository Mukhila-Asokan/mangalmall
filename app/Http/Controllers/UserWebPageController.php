<?php

namespace App\Http\Controllers;

use App\Models\UserWebPage;
use App\Models\UserWebPageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use App\Models\OccasionType;
use App\Models\OccasionDataField;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class UserWebPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $occasiontype = OccasionType::where('delete_status','0')->get();
        
        return view('home.userwebpage',compact('occasiontype'));
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
        $formData = $request->all();

        $userwebpage = new UserWebPage();
        $userwebpage->userid = Auth::user()->id;
        $userwebpage->occasion_id = $request->occasion_type;
        $userwebpage->validupto = '';
        $userwebpage->status = 'Active';
        $userwebpage->delete_status = 0;
        $userwebpage->save();

        foreach ($request->data_fields as $key => $value) {
            $userpagedata = new UserWebPageData();
            $userpagedata->userid = Auth::user()->id;
            $userpagedata->webpage_id = $userwebpage->id;
            $userpagedata->data_field_id = $key;
            $userpagedata->data_value = $value;
            $userpagedata->save();
        }

        return redirect()->route('user.webpage.template')->with('')
    }

    /**
     * Display the specified resource.
     */
    public function show(UserWebPage $userWebPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserWebPage $userWebPage)
    {
        //
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
    public function destroy(UserWebPage $userWebPage)
    {
        //
    }

    public function getoccasionfields($id)
    {
        $datafield = OccasionDataField::where('occasion_id', $id)->get();
    
        if ($datafield->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }
    
        return response()->json($datafield, 200);
    }
    

}
