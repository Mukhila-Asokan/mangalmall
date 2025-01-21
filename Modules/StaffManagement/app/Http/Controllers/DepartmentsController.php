<?php

namespace Modules\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\StaffManagement\Livewire\RoleComponent;
use Modules\StaffManagement\Models\Departments;
use Session;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageroot = "Staff";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Departments";
        $departments = Departments::where('delete_status','0')->paginate(10);
        return view('staffmanagement::departments.index',compact('departments','pageroot','username','userid','pagetitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageroot = "Staff";
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Departments";
        return view('staffmanagement::departments.create',compact('pageroot','username','userid','pagetitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'departmentname' => 'required|unique:departments',            
         ]);

        $departments = new Departments;
        $departments->departmentname = $request->departmentname;
        $departments->status = 'Active';
        $departments->save();
        return redirect('admin/staff/departments')->with('success', 'New Department created Successfully');
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
        $pagetitle = "Departments";
        $department = Departments::where('id',$id)->first();
        return view('staffmanagement::departments.edit',compact('pageroot','username','userid','pagetitle','department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $departments = Departments::find($id);
        $departments->departmentname = $request->departmentname;
        $departments->status = 'Active';
        $departments->save();
        return redirect('admin/staff/departments')->with('success', 'Department updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Departments::where('id', '=', $id)->update(['delete_status' => 1]);        
        return redirect('admin/staff/departments')->with('success', 'Department successfully deleted');
    }

    public function updatestatus($id) {    
        $department = Departments::where('id', '=', $id)->select('status')->first();
        $status = $department->status;
        $departmentstatus = "Active";
        if($status == "Active") {
            $departmentstatus = "Inactive";
        }
        Departments::where('id', '=', $id)->update(['status' => $departmentstatus]);
        return redirect('admin/staff/departments')->with('success', 'Department status successfully updated');
    }


}
