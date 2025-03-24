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
use Modules\VenueAdmin\Models\{VenueUser, VenueUserProfile};
use DataTables;
use Session;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Mail\VenueUserMail;
use Illuminate\Support\Facades\Mail;
use App\Models\BookingEnquiry;
use Modules\VenueAdmin\Models\UserVenue;
use Modules\Venue\Models\ModuleAccess;
Use Modules\Venue\Models\Menu;

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
                        $btn = '<div class="d-flex gap-2">
                            <a href="' . url('admin/staff/edit/' . $row->id) . '" class="edit btn btn-warning btn-sm"><i class="fa-solid fa-user-pen"></i></a>
                            <a href="' . url('admin/staff/detailview/' . $row->id) . '" class="view btn btn-primary btn-sm"><i class="tf-icon mdi mdi-eye"></i></a>
                            <a href="' . url('admin/staff/delete/' . $row->id) . '" class="view btn btn-danger btn-sm" id="delete_staff"><i class="fa fa-trash action_icon"></i></a>
                        </div>';
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
        $pagetitle = "Staff Details";
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
        $pagetitle = "Staff";
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

    public function updateStaff(Request $request){
        $staffid = $request->staffid;
        $emcont = StaffEmergency::where('staffid', $staffid)->first();
        $emcont->personname = $request->personname;
        $emcont->mobileno = $request->mobileno;
        $emcont->address = $request->address;
        $emcont->relationship = $request->relationship;
        $emcont->save();
        return redirect('admin/staff')->with('success', 'New Staff updated Successfully,');
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
            'email' => ['required', 'email', 'unique:admin_users,email']
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

            $staff = new Staff;
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

            $admin_user->staff_id = $staff->id;
            $admin_user->save();
            
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
            $staff_skills->skill_name = $skill_name;          
            $staff_skills->proficiency_level = $proficiency_level;
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
            $filename = $request->file('file_path')->store('staff_documents', 'public');
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
        $browserResponse['message']  = 'Profile photo added, Please check';
        return response()->json($browserResponse, 200);
    }

    public function editStaff($id){
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Staff Details";
        $pageroot = "Staff";
        
        $staff = Staff::where('id', $id)->first();
        $staff_qualification = StaffQualification::where('staffid',$id)->get();
        $staff_work = StaffWorkHistory::where('staffid',$id)->get();
        $staff_doc = StaffDocuments::where('staffid',$id)->get();
        $staff_skill = StaffSkills::where('staffid',$id)->get();
        $staff_em = StaffEmergency::where('staffid',$id)->first();

        $staffs = AdminUser::where('delete_status','0')->where('role','Admin')->orwhere('role','Staff')->get();
        $department = Departments::where('delete_status','0')->get();

        return view('staffmanagement::staff.edit',compact('username','userid','pagetitle','pageroot','staff','staff_qualification','staff_work','staff_doc','staff_skill','staff_em', 'staffs', 'department'));
    }

    public function qualificationDelete(Request $request){
        StaffQualification::where('id', $request->id)->delete();
        $staff_qualification = StaffQualification::where('staffid', $request->staff_id)->get();
        $browserResponse['status']   = 'success';
        $browserResponse['data']   = $staff_qualification;
        $browserResponse['message']  = 'Qualification deleted!, Please check';
        return response()->json($browserResponse, 200);
    }

    public function workhistoryDelete(Request $request){
        StaffWorkHistory::where('id', $request->id)->delete();
        $staff_history = StaffWorkHistory::where('staffid', $request->staff_id)->get();
        $browserResponse['status']   = 'success';
        $browserResponse['data']   = $staff_history;
        $browserResponse['message']  = 'Work History deleted!, Please check';
        return response()->json($browserResponse, 200);
    }

    public function skillDelete(Request $request){
        StaffSkills::where('id', $request->id)->delete();
        $staff_skill = StaffSkills::where('staffid', $request->staff_id)->get();
        $browserResponse['status']   = 'success';
        $browserResponse['data']     = $staff_skill;
        $browserResponse['message']  = 'Work History deleted!, Please check';
        return response()->json($browserResponse, 200);
    }

    public function docDelete(Request $request){
        StaffDocuments::where('id', $request->id)->delete();
        $staff_docs = StaffDocuments::where('staffid', $request->staff_id)->get();
        $browserResponse['status']   = 'success';
        $browserResponse['data']     = $staff_docs;
        $browserResponse['message']  = 'Document deleted!, Please check';
        return response()->json($browserResponse, 200);
    }

    public function ajaxupdate(Request $request){
        try{
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
                'email' => [
                    'required',
                    'email',
                    Rule::unique('admin_users', 'email')->ignore($request->staff_id, 'staff_id') 
                ]
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422); 
            }

            $role = ($request->supervisor_id == "") ? 'Admin' : 'Staff';
            $admin_user = AdminUser::where('staff_id', $request->staff_id)->first();
            $admin_user->name = $request->first_name .' '.$request->last_name;
            $admin_user->email  = $request->email;
            $admin_user->password = md5('123456789'); 
            $admin_user->role = $role;
            $admin_user->status = "Active";
            $admin_user->delete_status = 0;
            $admin_user->save();

            $staff = Staff::where('id', $request->staff_id)->first();
            $staff->adminuserid = $admin_user->id;
            $staff->first_name =  $first_name;
            $staff->last_name = $last_name;
            $staff->email = $email;
            $staff->phone = $phone;
            $staff->contact_address = $contact_address;
            $staff->location = $location;
            $staff->date_of_birth = $date_of_birth;
            $staff->hire_date = $hire_date;
            $staff->departmentid = $departmentid;
            $staff->roleid = $roleid;
            $staff->employee_code = "000";
            
            if($supervisor_id == "")
            $supervisor_id = 0;

            $staff->adminsupervisor_id =  $supervisor_id;
            $staff->status = "Active";
            $staff->delete_status = 0;
            $staff->save();

            $browserResponse['id']  = $staff->id;
            $browserResponse['status']   = 'success';
            $browserResponse['message']  = 'New Staff Created, Please check';
        }
        catch(\Exception $e){
            dd($e);
        }

        return response()->json($browserResponse, 200);
    }

    public function deleteStaff($id){
        try{
            $deleteAdmin = AdminUser::where('staff_id', $id)->update(['delete_status' => 1]);
            $deleteStaff = Staff::where('id', $id)->update(['delete_status' => 1]);
            return redirect('admin/staff')->with('success', 'Staff Deleted Successfully');
        }
        catch(\Exception $e){
            dd($e);
        }
    }

    //venue user
    public function createVenueUser($id){
        $staffId = $id;
        return view('staffmanagement::staff.venue_user.create', compact('staffId'));
    }

    public function storeVenueUser($staffId, Request $request){
        DB::beginTransaction();
        try{
            $venueUser = new VenueUser;
            $venueUser->name = $request->name;
            $venueUser->email = $request->email;
            $venueUser->mobileno = $request->mobile;
            $venueUser->city = $request->city;
            $venueUser->status = 'Inactive';
            $venueUser->save();

            $venueUserProfile = new VenueUserProfile;
            $venueUserProfile->venueuserid = $venueUser->id;
            $venueUserProfile->refferanceid = $staffId;
            $venueUserProfile->contact_address = $request->mobile;
            $venueUserProfile->	lostlogindetails = Carbon::now();
            $venueUserProfile->save();

            Mail::to($venueUser->email)->send(new VenueUserMail($venueUser, $venueUserProfile));

            DB::commit();
            return redirect()->back()->with('success', 'Venue User Created Successfully');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }

    public function listVenueUser($staffId){
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue User List";
        $pageroot = "Venue User";

        $staff = Staff::where('id', $staffId)->first();
        $admin = AdminUser::where('id', $staff->adminuserid)->first();

        $venueUserProfile = VenueUserProfile::where('refferanceid', $staffId)->pluck('venueuserid')->toArray();
        $venueUsers = VenueUser::whereIn('id', $venueUserProfile)->get();
        return view('staffmanagement::staff.venue_user.list', compact('venueUsers', 'staff', 'username', 'userid', 'pagetitle', 'pageroot'));
    }

    public function venueUserDetails($id){
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Venue User";
        $pageroot = "Venue User List";

        $venueUserProfile = VenueUserProfile::where('venueuserid', $id)->pluck('refferanceid')->first();
        $staff = Staff::where('id', $venueUserProfile)->first();

        $venueUser = VenueUser::where('id', $id)->where('delete_status', 0)->first();
        $venueIds = UserVenue::where('venueuserid', $venueUser->id)->pluck('venueid')->toArray();
        $bookingEnquiries = BookingEnquiry::whereIn('venue_id', $venueIds)->get();

        return view('staffmanagement::staff.venue_user.details', compact('venueUser', 'bookingEnquiries', 'staff', 'username', 'userid', 'pagetitle', 'pageroot'));
    }

    public function verifyAccount($id){
        $venueUser = VenueUser::Where('id', $id)->where('delete_status', 0)->first();
        $venueUser->status = 'Active';
        $venueUser->save();

        return redirect('venue/login')->with('success', 'Account Activate Successfully, Please login in');
    }

    public function viewModuleAccess(){
        $username = Session::get('username');
        $userid = Session::get('userid');       
        $pagetitle = "Module Access";
        $pageroot = "Module Access List";

        $roles = Roles::Where('delete_status', 0)->paginate(10);
        return view('staffmanagement::staff.module_access.list', compact('roles', 'username', 'userid', 'pagetitle', 'pageroot'));
    }

    public function editModuleAccess($id){
        try{
            $username = Session::get('username');
            $userid = Session::get('userid');       
            $pagetitle = "Module Access";
            $pageroot = "Module Access Edit";

            $role = Roles::where('id', $id)->first();
            $moduleAccess = ModuleAccess::where('role_id', $id)->pluck('menu_id')->toArray() ?? [];
            $menues = Menu::where('delete_status','0')->get();
            
            return view('staffmanagement::staff.module_access.edit', compact('menues', 'moduleAccess', 'username', 'userid', 'pagetitle', 'pageroot', 'role'));
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
            dd($e);
        }
    }

    public function updateModuleAccess(Request $request){
        try{
            ModuleAccess::where('role_id', $request->role_id)->delete();
            foreach($request->menu as $menu){
                ModuleAccess::create([
                    'menu_id' => $menu,
                    'role_id' => $request->role_id
                ]);
            }
            return redirect()->route('admin.module.access')->with('success', 'Module Access updated successfully');
        }
        catch(\Exception $e){
            dd($e);
        }
    }
}
