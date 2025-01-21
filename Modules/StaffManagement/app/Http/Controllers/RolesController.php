<?php

namespace Modules\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\StaffManagement\Models\Roles;
use Modules\StaffManagement\Models\Departments;
use Session;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Staff";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Roles";
        $roles = Roles::where('delete_status','0')->paginate(10);       
        return view('staffmanagement::roles.index',compact('roles','pageroot','username','userid','pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Staff";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Add New Role";     
        $department = Departments::where('delete_status','0')->get();
        return view('staffmanagement::roles.create',compact('pageroot','username','userid','pagetitle','department'));      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rolename' => 'required',
            'departmentid' => 'required',
         ]);

         $roles = new Roles;
         $roles->rolename = $request->rolename;
         $roles->departmentid = $request->departmentid;
         $roles->status = 'Active';
         $roles->save();
         return redirect('admin/staff/roles')->with('success', 'Roles created Successfully');

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('staffmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageroot = "Staff";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Edit Role";
        $roles = Roles::where('id',$id)->first();
        $department = Departments::where('delete_status','0')->get();
        return view('staffmanagement::roles.edit',compact('pageroot','username','userid','pagetitle','department','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $id = $request->id;
         $roles = Roles::find($id);
         $roles->rolename = $request->rolename;
         $roles->departmentid = $request->departmentid;
         $roles->status = 'Active';
         $roles->save();
         return redirect('admin/staff/roles')->with('success', 'Roles updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Roles::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/staff/roles')->with('success', 'Roles successfully deleted');
    }

    public function updatestatus($id) {    
        $roles = Roles::where('id', '=', $id)->select('status')->first();
        $status = $roles->status;
        $rolesstatus = "Active";
        if($status == "Active") {
            $rolesstatus = "Inactive";
        }
        Roles::where('id', '=', $id)->update(['status' => $rolesstatus]);
        return redirect('admin/staff/roles')->with('success', 'Roles status successfully updated');
    }
}
