<?php

namespace Modules\Venue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use Modules\Venue\Models\State;
use Session;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "State";
         $pageroot = "Venue";
        $states = State::where('delete_status',0)->paginate(20);
        return view('venue::state.index',compact('states','pagetitle','pageroot','username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
         $userid = Session::get('userid');       
         $pagetitle = "State";
         $pageroot = "Venue";
        return view('venue::state.create',compact('pagetitle','pageroot','username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'statename' => 'required|unique:state'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

            $statename = new State;
            $statename->statename  = $request->statename;
            $statename->status = 'Active';
            $statename->delete_status = 0;
            $statename->save();

        return redirect('admin/state')->with('success', 'State details successfully added');    
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
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "State";
        $pageroot = "Venue";
        $state = State::where('id',$id)->first();
        return view('venue::state.edit',compact('state','pagetitle','pageroot','username'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'statename' => 'required|unique:state,statename,'.$id.'|max:255',
        ]);
       
        if ($validator->fails()) {
            return redirect(url()->previous())
                    ->withErrors($validator)
                    ->withInput();
        }

            $statename = State::find($id);
            $statename->statename  = $request->statename;
            $statename->status = 'Active';
            $statename->delete_status = 0;
            $statename->save();

        return redirect('admin/state')->with('success', 'State details successfully added');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        State::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/state')->with('success', 'State details successfully deleted');
    }
    public function updatestatus($id) {    
      
        $state = State::find($id);   
        if (!$state) {
            return redirect('admin/state')->with('error', 'State not found.');
        } 
        $state->status = ($state->status === 'Active') ? 'Inactive' : 'Active';
        $state->save();

        return redirect('admin/state')->with('success', 'State status successfully updated.');
    }
}
