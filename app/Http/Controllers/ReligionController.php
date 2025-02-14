<?php

namespace App\Http\Controllers;

use App\Models\Admin\Religion;
use App\Http\Requests\StoreReligionRequest;
use App\Http\Requests\UpdateReligionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Svg\Tag\Rect;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Religion";
        $pageroot = "Venue Settings";
        $religions = Religion::where('delete_status', 0)->paginate(20);
        return view('admin.religion.index', compact('religions', 'pagetitle', 'pageroot', 'username'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');   
        $userid = Session::get('userid');
        $pagetitle = "Religion";
        $pageroot = "Venue Settings";
        return view('admin.religion.create', compact('pagetitle', 'pageroot', 'username')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'religionname' => 'required|unique:religions'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {           
                $religion = new Religion();
                $religion->religionname = $request->religionname;
                $religion->status = 'Active';
                $religion->delete_status = 0;
                $religion->save();
                return redirect('admin/religion')->with('success', 'Religion added successfully.');  
       
        } catch (\Exception $e) {     
        return redirect('admin/religion')->with('error', $e->getMessage());  
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Religion $religion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');
        $pagetitle = "Religion";
        $pageroot = "Venue Settings";
        $religion = Religion::where('id', $id)->first();
        return view('admin.religion.edit', compact('religion', 'pagetitle', 'pageroot', 'username')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
             'religionname' => 'required|unique:religions,religionname,'.$id.'|max:255'
        ]); 

        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }

        try {           
                $religion = Religion::find($id);
                $religion->religionname = $request->religionname;
                $religion->status = 'Active';
                $religion->delete_status = 0;
                $religion->save();
                return redirect('admin/religion')->with('success', 'Religion added successfully.');  
       
    } catch (\Exception $e) {     
        return redirect('admin/religion')->with('error', $e->getMessage());  
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Religion::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/religion')->with('success', 'Religion details successfully deleted');
    }

    public function updatestatus($id) {    
      
        $religion = Religion::find($id);   
        if (!$religion) {
            return redirect('admin/religion')->with('error', 'Religion not found.');
        } 
        $religion->status = ($religion->status === 'Active') ? 'Inactive' : 'Active';
        $religion->save();

        return redirect('admin/religion')->with('success', 'Religion status successfully updated.');
    }
}
