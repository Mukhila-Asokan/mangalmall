<?php

namespace Modules\StaffManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Modules\StaffManagement\Models\Roles;
use Modules\StaffManagement\Models\Departments;
Use Modules\StaffManagement\Models\Staff;
Use Modules\StaffManagement\Models\StaffDocuments;
Use Modules\StaffManagement\Models\StaffEmergency;
Use Modules\StaffManagement\Models\StaffQualification;
Use Modules\StaffManagement\Models\StaffSkills;
Use Modules\StaffManagement\Models\StaffWorkHistory;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminUser;
use DataTables;
use Session;


class StaffManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Staff List";
        $pageroot = "Staff";    
        $staff = Staff::where('delete_status','0')->get();

        if ($request->ajax()) {

           
            return Datatables::of($staff)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="'.url('admin/staff/detailview/'.$row->id).'" class="edit btn btn-primary btn-sm">View</a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
          
        return view('staffmanagement::staff.index',compact('username','userid','pagetitle','pageroot'));
    }


    public function detailview($id)
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Staff List";
        $pageroot = "Staff";   
        $staff = Staff::where('id',$id)->first();
        $staff_qualification = StaffQualification::where('staffid',$id)->get();
        $staff_work = StaffWorkHistory::where('staffid',$id)->get();
        $staff_doc = StaffDocuments::where('staffid',$id)->get();
        $staff_skill = StaffSkills::where('staffid',$id)->get();
        $staff_em = StaffEmergency::where('staffid',$id)->get();

        return view('staffmanagement::staff.detailview',compact('username','userid','pagetitle','pageroot','staff','staff_qualification','staff_work','staff_doc','staff_skill','staff_em'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Staff List";
        $pageroot = "Staff";    
        $department = Departments::where('delete_status','0')->get();

        $staff = AdminUser::where('delete_status','0')->where('role','Admin')->orwhere('role','Staff')->get();
        $roles = Roles::where('delete_status','0')->get();
        return view('staffmanagement::staff.create',compact('username','userid','pagetitle','pageroot','department','roles','staff'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $staffid = $request->staffid;
        $emcont = new StaffEmergency;
        $emcont->personname = $request->personname;
        $emcont->mobileno = $request->mobileno;
        $emcont->address = $request->address;
        $emcont->staffid = $staffid;
        $emcont->relationship = $request->relationship;
        $emcont->save();
        return redirect('admin/staff')->with('success', 'New Staff added Successfully,');

    }

    public function profile()
    {
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Staff List";
        $pageroot = "Staff";   
        $staff = Staff::where('delete_status','0')->get();
        return view('staffmanagement::staff.detailview',compact('username','userid','pagetitle','pageroot','staff'));
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
        return view('staffmanagement::edit');
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
    public function destroy($id)
    {
        //
    }


    public function getroleusingdepid(Request $request)
    {
        $depid = $request->departmentid;
        $roles = Roles::where('departmentid',$depid)->get();
        return response()->json($roles, 200);

    }
    public function ajaxstore(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone = $request->phone;
        $contact_address = $request->contact_address;
        $location = $request->location;
        $date_of_birth = $request->date_of_birth;
        $hire_date = $request->hire_date;
        $roleid = $request->roleid;
        $departmentid = $request->departmentid;
        $supervisor_id = $request->supervisor_id ?? '';

        $validator = Validator::make($request->all(),[
            'phone' => 'required', 'string', 'regex:/^[0-9]{10}$/',
            'first_name' => 'required',
            'last_name' => 'required',         
            'contact_address' => 'required',
            'location' => 'required',
            'date_of_birth' => 'required',
            'hire_date' => 'required',
            'roleid' => 'required',
            'departmentid' => 'required',         
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        $mobilenocheck = Staff::where('phone',$request->phone)->first();

        if(empty($mobilenocheck))
        {

            
            $role = ($request->supervisor_id == "") ? 'Admin' : 'Staff';
            $admin_user = new AdminUser;
            $admin_user->name = $request->first_name .' '.$request->last_name;
            $admin_user->email  = $request->email;
            $admin_user->password = md5('123456789'); 
            $admin_user->role = $role;
            $admin_user->status = "Active";
            $admin_user->delete_status = 0;
            $admin_user->save();

            $staff = new staff;
            $staff->adminuserid = $admin_user->id;
            $staff->first_name =  $first_name;
            $staff->last_name = $last_name;
            $staff->email = $email;
            $staff->staff_photo = "";
            $staff->phone = $phone;
            $staff->contact_address = $contact_address;
            $staff->location = $location;
            $staff->date_of_birth = $date_of_birth;
            $staff->hire_date = $hire_date;
            $staff->departmentid = $departmentid;
            $staff->roleid = $roleid;
            $staff->employee_code = "000";
           
            
            if($supervisor_id== "")
                $supervisor_id = 0;

            $staff->adminsupervisor_id =  $supervisor_id;
           
            
            $staff->status = "Active";
            $staff->delete_status = 0;

            

            $staff->save();

            $browserResponse['id']  = $staff->id;
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'New Staff Created, Please check';
        }
        else
        {
            $browserResponse['status']   = 'failed';
            $browserResponse['message']  = 'Please check your mobile no';
        }

     
        return response()->json($browserResponse, 200);
    }

    public function ajaxqualification(Request $request)
    {
        $staffid = $request->staffid;
        $degreename = $request->degreename;
        $qualification_type = $request->qualification_type;
        $institution = $request->institution;
        $completion_date = $request->completion_date;

        $validator = Validator::make($request->all(),[
            'staffid' => 'required',
            'degreename' => 'required',
            'qualification_type' => 'required',
            'completion_date' => 'required',
            'institution' => 'required' 
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        if($staffid)
        {
            $staff_qualification = new StaffQualification;
            $staff_qualification->staffid = $staffid;
            $staff_qualification->degreename = $degreename;
            $staff_qualification->qualification_type = $qualification_type;
            $staff_qualification->institution = $institution;
            $staff_qualification->completion_date = $completion_date;
            $staff_qualification->save();
            $details = StaffQualification::where('staffid',$staffid)->get();
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'New Qualification details added, Please check';
            $browserResponse['details'] = $details;
            }
            else
            {
                    $browserResponse['status']   = 'failed';
                    $browserResponse['message']  = 'Please check your entered details';
            }

    return response()->json($browserResponse, 200);

    }
    public function ajaxworkingdetails(Request $request)
    {
        $staffid = $request->staffid;
        $employeername = $request->employeername;
        $desgination = $request->desgination;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $leavereason = $request->leavereason;

        $validator = Validator::make($request->all(),[
            'staffid' => 'required',
            'employeername' => 'required',
            'desgination' => 'required',
            'start_date' => 'required' ,
            'end_date' => 'required' ,
            'leavereason' => 'required' ,
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        if($staffid)
        {
            $staff_workingdetails = new StaffWorkHistory;
            $staff_workingdetails->staffid = $staffid;
            $staff_workingdetails->employeername = $employeername;
            $staff_workingdetails->desgination = $desgination;
            $staff_workingdetails->start_date = $start_date;
            $staff_workingdetails->end_date = $end_date;
            $staff_workingdetails->leavereason = $leavereason;
            $staff_workingdetails->save();

            $details = StaffWorkHistory::where('staffid',$staffid)->get();
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'New Working details added, Please check';
            $browserResponse['details'] = $details;
            }
            else
            {
                    $browserResponse['status']   = 'failed';
                    $browserResponse['message']  = 'Please check your entered details';
            }

    return response()->json($browserResponse, 200);
    }

    public function ajaxskillset(Request $request)
    {
        $staffid = $request->staffid;
        $skill_name = $request->skill_name;
        $proficiency_level = $request->proficiency_level;
       

        $validator = Validator::make($request->all(),[
            'staffid' => 'required',
            'skill_name' => 'required',
            'proficiency_level' => 'required',           
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        if($staffid)
        {
            $staff_skills = new StaffSkills;
            $staff_skills->staffid = $staffid;          
            $staff_skills->desgination = $proficiency_level;
          
            $staff_skills->save();

            $details = StaffSkills::where('staffid',$staffid)->get();
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'New Skill set added, Please check';
            $browserResponse['details'] = $details;
            }
            else
            {
                    $browserResponse['status']   = 'failed';
                    $browserResponse['message']  = 'Please check your entered details';
            }

    return response()->json($browserResponse, 200);
    }

    public function ajaxdocuments(Request $request)
    {
        $staffid = $request->staffid;
        $document_name = $request->document_name;
        $validator = Validator::make($request->all(),[
            'staffid' => 'required',
            'document_name' => 'required',
            'file_path' => 'required',           
        ]);

      

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); 
        }

        if($request->hasFile('file_path')){         
            $filename = $request->file('file_path')->store('staff_documents', 'public');;

        }

        if($staffid)
        {
            $staff_docs = new StaffDocuments;
            $staff_docs->staffid = $staffid;
            $staff_docs->document_name = $document_name;
            $staff_docs->file_path = $filename;
          
            $staff_docs->save();

            $details = StaffDocuments::where('staffid',$staffid)->get();
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'New documents added, Please check';
            $browserResponse['details'] = $details;
            }
            else
            {
                    $browserResponse['status']   = 'failed';
                    $browserResponse['message']  = 'Please check your entered details';
            }

            return response()->json($browserResponse, 200);
    }

    public function ajaxphotoadd(Request $request)
    {
        $staffid = $request->staffid;
        if($request->hasFile('staff_photo')){         
            $filename = $request->file('staff_photo')->store('staff_photo', 'public');;

        }
        $staff = Staff::find($staffid);
        $staff->staff_photo = $filename;
        $staff->save();
        $browserResponse['status']   = 'success';
        $browserResponse['message']  = 'New Skill set added, Please check';
        return response()->json($browserResponse, 200);

    }

}
