<?php

namespace Modules\VenueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VenueAdmin\Models\VenueStaff;
use Illuminate\Support\Facades\Validator;
use DB;

class StaffController extends Controller
{
    public function index(){
        
        $userId = \Session::get('venueuserid');
        $venueStaffs = VenueStaff::where('venue_admin_id', $userId)->get();
        $pagetitle = 'Venue Staff List';
        return view('venueadmin::staff.list',compact('venueStaffs','userId', 'pagetitle'));
    }

    public function add(){
        $pagetitle = 'Add Venue Staff';
        return view('venueadmin::staff.add', compact('pagetitle'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'staff_code' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try{
            $createStaff = new VenueStaff;
            $createStaff->venue_admin_id = \Session::get('venueuserid');
            $createStaff->first_name = $request->first_name;
            $createStaff->last_name = $request->last_name;
            $createStaff->staff_code = $request->staff_code;
            $createStaff->email = $request->email;
            $createStaff->mobile_number = $request->mobile_number;
            $createStaff->address = $request->address;
            $createStaff->hired_date = $request->hired_date;
            $createStaff->date_of_birth = $request->date_of_birth;
            $createStaff->save();
            DB::commit();
            return redirect()->route('venueadmin.list.staff')->with('success', 'Venue Staff Created Sucessfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id){
        try{
            $pagetitle = 'Edit Venue Staff';
            $staff = VenueStaff::where('id', $id)->first();
            return view('venueadmin::staff.edit', compact('staff', 'pagetitle'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request){
        DB::beginTransaction();
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'staff_code' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try{
            $createStaff = VenueStaff::where('id', $request->staff_id)->first();
            $createStaff->venue_admin_id = \Session::get('venueuserid');
            $createStaff->first_name = $request->first_name;
            $createStaff->last_name = $request->last_name;
            $createStaff->staff_code = $request->staff_code;
            $createStaff->email = $request->email;
            $createStaff->mobile_number = $request->mobile_number;
            $createStaff->address = $request->address;
            $createStaff->hired_date = $request->hired_date;
            $createStaff->date_of_birth = $request->date_of_birth;
            $createStaff->save();
            DB::commit();
            return redirect()->route('venueadmin.list.staff')->with('success', 'Venue staff updated Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try{
            $deleteRecord = VenueStaff::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('venueadmin.list.staff')->with('success', 'Venue staff deleted Successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
            DB::rollback();
        }
    }
}
