@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
   .imageOutput img
   {
   width:200px;
   height:auto;
   }
</style>
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">Add {!! $pagetitle !!}</h4>
            <div class="text-end">
               <a href = "{{ route('admin/staff') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
               <span class="tf-icon mdi mdi-eye me-1"></span> Staff List
               </a>
            </div>
            <ul class="nav nav-pills navtab-bg nav-justified">
               <li class="nav-item">
                  <a href="#profiledetails" aria-expanded="false" class="nav-link active">
                  <span class="d-inline-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                  <span class="d-none d-sm-inline-block">Profile Details</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="#qualification" aria-expanded="true" class="nav-link navqualification">
                  <span class="d-inline-block d-sm-none"><i class="mdi mdi-account"></i></span>
                  <span class="d-none d-sm-inline-block">Qualification</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="#workhistory" aria-expanded="false" class="nav-link navworkhistory">
                  <span class="d-inline-block d-sm-none"><i class="mdi mdi-email-variant"></i></span>
                  <span class="d-none d-sm-inline-block">Work History</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="#skillset" aria-expanded="false" class="nav-link navskillset">
                  <span class="d-inline-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                  <span class="d-none d-sm-inline-block">Skill Set</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="#docs" aria-expanded="false" class="nav-link navdocs">
                  <span class="d-inline-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                  <span class="d-none d-sm-inline-block">Upload Docs & Photos</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="#contact" aria-expanded="false" class="nav-link navContact">
                    <span class="d-inline-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                    <span class="d-none d-sm-inline-block">Emergency Contact</span>
                  </a>
               </li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane show active" id="profiledetails">
                  <div class ="row">
                     <div class="col-6">
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="first_name">First Name</label>
                           <div class="col-md-8">
                              <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter the First name" value = "{{ $staff->first_name }}" required>
                              <div class="alert alert-danger failmessage first_name mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="last_name">Last Name</label>
                           <div class="col-md-8">
                              <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter the Last name" value = "{{ $staff->last_name }}" required>
                              <div class="alert alert-danger failmessage last_name mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="contact_address">Contact Address</label>
                           <div class="col-md-8">
                              <textarea type="text" id="contact_address" name="contact_address" class="form-control" placeholder="Enter the Contact Address" required>{{ $staff->contact_address }}</textarea>
                              <div class="alert alert-danger failmessage contact_address mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="date_of_birth">Date of Birth</label>
                           <div class="col-md-8">
                              <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value = "{{ $staff->date_of_birth }}" required>
                              <div class="alert alert-danger failmessage date_of_birth mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="hire_date">Hire Date</label>
                           <div class="col-md-8">
                              <input type="date" id="hire_date" name="hire_date" class="form-control" value = "{{ $staff->hire_date }}" required>
                              <div class="alert alert-danger failmessage hire_date mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="supervisor_id">Reporting</label>
                           <div class="col-md-8">
                              <select id="supervisor_id" name="supervisor_id" class="form-control" >
                                 <option value= "">Select</option>
                                 @foreach($staffs as $st)
                                    <option value="{{ $st->id }}" {{ $st->id == $staff->adminsupervisor_id ? 'selected' : '' }}> 
                                        {{ $st->name }} 
                                    </option>
                                @endforeach
                              </select>
                              <div class="alert alert-danger failmessage supervisor_id mt-3" style="display:none"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="email">Email ID</label>
                           <div class="col-md-8">
                              <input type="text" id="email" name="email" class="form-control" placeholder="Enter the Email Id" value = "{{ $staff->email }}" required>
                              <div class="alert alert-danger failmessage email mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="phone">Mobile No</label>
                           <div class="col-md-8">
                              <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter the Mobile No" value = "{{ $staff->phone }}" required>
                              <div class="alert alert-danger failmessage phone mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="location">Location</label>
                           <div class="col-md-8">
                              <input type="text" id="location" name="location" class="form-control" placeholder="Enter the Location" value = "{{ $staff->location }}" required>
                              <div class="alert alert-danger failmessage location mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <br>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="departmentname">Department</label>
                           <div class="col-md-8">
                              <select id="departmentid" name="departmentid" class="form-control" >
                                 <option value ="">Select Department</option>
                                 @foreach($department as $dept)
                                    <option value="{{ $dept->id }}" {{ $dept->id == $staff->departmentid ? 'selected' : '' }}> {{ $dept->departmentname }}</option>
                                 @endforeach
                              </select>
                              <div class="alert alert-danger failmessage departmentid mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="roleid">Role</label>
                           <div class="col-md-8">
                              <select id="roleid" name="roleid" class="form-control" >
                                 <option  value ="">Select Role</option>
                              </select>
                              <div class="alert alert-danger failmessage roleid mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="justify-content-end row">
                           <div class="col-sm-6">
                              <button type="button" class="btn btn-primary waves-effect waves-light staffdetails">Update & Continue</button>	
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="qualification">
                    <div class ="row">
                        <div class="col-6">
                            <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="degreename">Degree Name</label>
                            <div class="col-md-8">
                                <input type="text" id="degreename" name="degreename" class="form-control" placeholder="Enter the Degree name" value = "{{ old('degreename') }}" required>
                                <div class="alert alert-danger failmessage degreename mt-3" style="display:none"></div>
                            </div>
                            </div>
                            <br>
                            <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="qualification_type">Field of Study</label>
                            <div class="col-md-8">
                                <input type="text" id="qualification_type" name="qualification_type" class="form-control" placeholder="Enter the Field of Study" value = "{{ old('qualification_type') }}" required>
                                <div class="alert alert-danger failmessage qualification_type mt-3" style="display:none"></div>
                            </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="institution">Institution Name</label>
                            <div class="col-md-8">
                                <textarea type="text" id="institution" name="institution" class="form-control" required>{{ old('institution') }}</textarea>
                                <div class="alert alert-danger failmessage institution mt-3" style="display:none"></div>
                            </div>
                            </div>
                            <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="completion_date">Completion Date</label>
                            <div class="col-md-8">
                                <input type="date" id="completion_date" name="completion_date" class="form-control" value = "{{ old('completion_date') }}" required>
                                <div class="alert alert-danger failmessage completion_date mt-3" style="display:none"></div>
                            </div>
                            </div>
                        </div>
                    </div>
                  <div class="row mt-3">
                     <div class="justify-content-end row">
                        <div class="col-sm-2">
                           <button type="button" class="btn btn-primary waves-effect waves-light addqualification"> <span class="tf-icon mdi mdi-plus me-1"></span> Add</button>	
                        </div>
                     </div>
                     <div class= "table-responsive mt-3">
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Degree Name</th>
                                    <th>Field of Study</th>
                                    <th>Institution</th>
                                    <th>Completion Date</th>
                                    <th>Action</th>
                                </tr>
                           </thead>
                           <tbody id = "qualificationtable">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="justify-content-end row">
                        <div class="col-sm-4">
                           <button type="button" class="btn btn-primary waves-effect waves-light savedegree">Update & Continue</button>	
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="workhistory">
                  <div class ="row">
                     <div class="col-6">
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="employeername">Company Name with Location</label>
                           <div class="col-md-8">
                              <textarea type="text" id="employeername" name="employeername" class="form-control" value = "{{ old('employeername') }}" required></textarea>
                              <div class="alert alert-danger failmessage employeername mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <br>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="desgination">Designation</label>
                           <div class="col-md-8">
                              <input type="text" id="desgination" name="desgination" class="form-control" placeholder="Enter the Field of Study" value = "{{ old('desgination') }}" required>
                              <div class="alert alert-danger failmessage desgination mt-3" style="display:none"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="start_date">Start Date</label>
                           <div class="col-md-8">
                              <input type="date" id="start_date" name="start_date" class="form-control" value = "{{ old('start_date') }}" required>
                              <div class="alert alert-danger failmessage start_date mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="end_date">End Date</label>
                           <div class="col-md-8">
                              <input type="date" id="end_date" name="end_date" class="form-control" value = "{{ old('end_date') }}" required>
                              <div class="alert alert-danger failmessage end_date mt-3" style="display:none"></div>
                           </div>
                        </div>
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="leavereason">Reason for Leave</label>
                           <div class="col-md-8">
                              <textarea type="text" id="leavereason" name="leavereason" class="form-control" value = "{{ old('leavereason') }}" required></textarea>
                              <div class="alert alert-danger failmessage leavereason mt-3" style="display:none"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="justify-content-end row">
                        <div class="col-sm-2">
                           <button type="button" class="btn btn-primary waves-effect waves-light" id = "addworkingdetails"> <span class="tf-icon mdi mdi-plus me-1"></span> Add</button>	
                        </div>
                     </div>
                     <div class= "table-responsive mt-3">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Company name</th>
                                 <th>Designation</th>
                                 <th>Start Date</th>
                                 <th>End Date</th>
                                 <th>Reason for Leave</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id="workdetailstable">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="justify-content-end row">
                        <div class="col-sm-4">
                           <button type="button" class="btn btn-primary waves-effect waves-light saveworking">Update & Continue</button>	
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="skillset">
                  <div class ="row">
                     <div class="col-6">
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="skill_name">Skill Name</label>
                           <div class="col-md-8">
                              <input type="text" id="skill_name" name="skill_name" class="form-control" placeholder="Enter the Field of Study" value = "{{ old('skill_name') }}" required>
                              <div class="alert alert-danger failmessage skill_name mt-3" style="display:none"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="mb-4 row">
                           <label class="col-md-4 col-form-label" for="proficiency_level">Skill Name</label>
                           <div class="col-md-8">
                              <select id="proficiency_level" name="proficiency_level" class="form-control" required>
                                 <option value="">Select Level</option>
                                 <option value="Beginner">Beginner</option>
                                 <option value="Intermediate">Intermediate</option>
                                 <option value="Expert">Expert</option>
                              </select>
                              <div class="alert alert-danger failmessage proficiency_level mt-3" style="display:none"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="justify-content-end row">
                        <div class="col-sm-2">
                           <button type="button" class="btn btn-primary waves-effect waves-light" id = "addskillset"> <span class="tf-icon mdi mdi-plus me-1"></span> Add</button>	
                        </div>
                     </div>
                     <div class= "table-responsive mt-3">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Skill Name</th>
                                 <th>Proficiency Level</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody id = "skillsettable">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="justify-content-end row">
                        <div class="col-sm-4">
                           <button type="button" class="btn btn-primary waves-effect waves-light saveskills">Update & Continue</button>	
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="docs">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4 row">
                            <label for="formFile" class="form-label">Employee Profile Photo</label>
                            <input class="form-control imageUpload" type="file" id="formFile" name = "staff_photo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="justify-content-start row mb-4">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary waves-effect waves-light mt-4 p-2" id="uploadimage">Upload Image</button>	
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id = "categoryiconimage" class="imageOutput" style="width:200px;height:200px;border:1px solid #333">
                            <img src="{{ asset('storage/' . $staff->staff_photo) }}">
                        </div>
                    </div>
                  <br>
                  <div class="row">
                     <div class="col-5">
                        <div class="mb-4 row">
                           <label class="col-md-3 col-form-label" for="document_name">Document Name</label>
                           <div class="col-md-9">
                              <input type="text" id="document_name" name="document_name" class="form-control" value = "{{ old('document_name') }}" required>
                              <div class="alert alert-danger failmessage document_name mt-3" style="display:none"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-5">
                        <div class="mb-4 row">
                           <label class="col-md-3 col-form-label" for="file_path">Uplaod File</label>
                           <div class="col-md-9">
                              <input type="file" id="file_path" name="file_path" class="form-control" value = "{{ old('file_path') }}" required>
                              <div class="alert alert-danger failmessage file_path mt-3" style="display:none"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-2">
                        <div class="justify-content-end row">
                            <div class="upload-btn">
                                <button type="button" class="btn btn-primary waves-effect waves-light uploadfiles"> <span class="tf-icon mdi mdi-plus me-1"></span> Add</button>	
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class= "table-responsive mt-3">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Document Name</th>
                                 <th>File</th>
                              </tr>
                           </thead>
                           <tbody id="uploadfilestable">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="justify-content-end row">
                        <div class="col-sm-4">
                           <button type="button" class="btn btn-primary waves-effect waves-light savedocs">Update & Continue</button>	
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane" id="contact">
                  <form class="form-horizontal" role="form" method = "post" action="{{ route('staff.staff_update') }}">
                     @csrf
                     <input type = "hidden" name = "staffid" id ="staffid" value = "{{ $staff->id }}" />
                     <div class ="row">
                        <div class="col-6">
                           <div class="mb-4 row">
                              <label class="col-md-4 col-form-label" for="personname">Person Name</label>
                              <div class="col-md-8">
                                 <input type="text" id="personname" name="personname" class="form-control" placeholder="Enter the Person Name" value = "{{ $staff_em->personname }}" required>
                                 <div class="alert alert-danger failmessage personname mt-3" style="display:none"></div>
                              </div>
                           </div>
                           <div class="mb-4 row">
                              <label class="col-md-4 col-form-label" for="mobileno">Mobile No</label>
                              <div class="col-md-8">
                                 <input type="text" id="mobileno" name="mobileno" class="form-control" placeholder="Enter the Mobile No" value = "{{ $staff_em->mobileno }}" required>
                                 <div class="alert alert-danger failmessage mobileno mt-3" style="display:none"></div>
                              </div>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="mb-4 row">
                              <label class="col-md-4 col-form-label" for="address">Contact Address</label>
                              <div class="col-md-8">
                                 <textarea type="text" id="address" name="address" class="form-control" placeholder="Enter the Contact Address" required>{{ $staff_em->address }}</textarea>
                                 <div class="alert alert-danger failmessage address mt-3" style="display:none"></div>
                              </div>
                           </div>
                           <div class="mb-4 row">
                              <label class="col-md-4 col-form-label" for="relationship">Relationship</label>
                              <div class="col-md-8">
                                 <input type="text" id="relationship" name="relationship" class="form-control" placeholder="Enter the relationship" value = "{{ $staff_em->relationship }}" required>
                                 <div class="alert alert-danger failmessage relationship mt-3" style="display:none"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="justify-content-end row">
                           <div class="col-sm-2">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>	
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
   	$images = $('#categoryiconimage')
    $(".imageUpload").change(function(event){
        readURL(this);
    });

    $(document).ready(function(){
        $("#qualificationtable").empty();
        $("#workdetailstable").empty();
        $('#skillsettable').empty();
        $("#uploadfilestable").empty();

        var departmentid = <?= $staff->departmentid ?>;
		$.ajax({
			type:'POST',
			url:"{{ route('staff.getroleusingdepid') }}",
			dataType: 'json',
			data:{ "_token": "{{ csrf_token() }}", "departmentid" :departmentid},
			success:function(response){  
				$("#roleid").empty();   
				var returnData = response;   
				if(returnData.length>0)
				{
					let casestr = '<option>Select Roles</option>';
					for(i=0;i<returnData.length;i++)
					{
                        if(returnData[i]['id'] == <?= $staff->roleid ?>){
						    casestr  += '<option selected value = "' + returnData[i]['id'] + ' ">' + returnData[i]['rolename'] + '</option>';
                        }
                        else{
						    casestr  += '<option value = "' + returnData[i]['id'] + ' ">' + returnData[i]['rolename'] + '</option>';
                        }
					}
					console.log(casestr);       
					$("#roleid").append(casestr);
				}
				else
				{
					alert("No Data")
				}
			}
		});

        var qualification = <?= $staff_qualification ?>;   
        if(qualification.length > 0){
            let casestr = '';
            for(i=0;i<qualification.length;i++){
                casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + qualification[i]['degreename'] + '</td><td>' + qualification[i]['qualification_type'] + '</td><td>'+ qualification[i]['institution'] +'</td><td>'+ qualification[i]['completion_date'] + '</td><td><button class="btn btn-danger btn-sm delete-qualification" data-id="' + qualification[i]['id'] + '">Delete</button></td></tr>';
            }
            console.log(casestr);       
            $("#qualificationtable").append(casestr);
        }

        var workHistory = <?= $staff_work ?>;
        if(workHistory.length > 0){
            let casestr = '';
            for(i=0; i<workHistory.length; i++){
                casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + workHistory[i]['employeername'] + '</td><td>' + workHistory[i]['desgination'] + '</td><td>'+ workHistory[i]['start_date'] +'</td><td>'+ workHistory[i]['end_date'] +'</td><td>'+ workHistory[i]['leavereason'] + '</td><td><button class="btn btn-danger btn-sm delete-work-history" data-id="' + workHistory[i]['id'] + '">Delete</button></td></tr>';
            }
            console.log(casestr);       
            $("#workdetailstable").append(casestr);
        }

        var skillSet = <?= $staff_skill ?>;
        console.log(skillSet, 'skillSet');
        if(skillSet.length > 0){
            let casestr = '';
            for(i=0; i<skillSet.length; i++){
                casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + skillSet[i]['skill_name'] + '</td><td>' + skillSet[i]['proficiency_level'] +'</td><td><button class="btn btn-danger btn-sm delete-skill" data-id="' + skillSet[i]['id'] + '">Delete</button></td></tr>';
            }
            console.log(casestr);       
            $("#skillsettable").append(casestr);
        }

        var staffDoc = <?= $staff_doc ?>;
        if(staffDoc.length > 0){
            let casestr = '';
            for(let i = 0; i < staffDoc.length; i++){
                casestr += `<tr>
                    <td>${i + 1}</td>
                    <td>${staffDoc[i]['document_name']}</td>
                    <td><a href="/storage/${staffDoc[i]['file_path']}" target="_blank">View File</a></td>
                    <td><button class="btn btn-danger btn-sm delete-doc" data-id="${staffDoc[i]['id']}">Delete</button></td>
                </tr>`;
            }
            console.log(casestr);       
            $("#uploadfilestable").append(casestr);
        }
    })

    $(document).on('click', '.delete-qualification', function(){
        $id = $(this).data('id');
        if (confirm("Are you sure you want to delete this qualification?")) {
            $.ajax({
                url: "{{ route('staff.qualification.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $id,
                    staff_id: <?= $staff->id ?>
                },
                success: function(response) {
                    $("#qualificationtable").empty();
                    var returnData = response.data;
                    if(returnData.length > 0){
                        let casestr = '';
                        for(i=0;i<returnData.length;i++){
                            casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + returnData[i]['degreename'] + '</td><td>' + returnData[i]['qualification_type'] + '</td><td>'+ returnData[i]['institution'] +'</td><td>'+ returnData[i]['completion_date'] + '</td><td><button class="btn btn-danger btn-sm delete-qualification" data-id="' + returnData[i]['id'] + '">Delete</button></td></tr>';
                        }
                        console.log(casestr);       
                        $("#qualificationtable").append(casestr);
                    }
                },
                error: function(response) {
                    alert("Something went wrong.");
                }
            })
        }
    })

    $(document).on('click', '.delete-work-history', function(){
        $id = $(this).data('id');
        if (confirm("Are you sure you want to delete this work history?")) {
            $.ajax({
                url: "{{ route('staff.workhistory.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $id,
                    staff_id: <?= $staff->id ?>
                },
                success: function(response) {
                    $("#workdetailstable").empty();
                    var returnData = response.data;
                    if(returnData.length > 0){
                        let casestr = '';
                        for(i=0;i<returnData.length;i++){
                            casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + returnData[i]['employeername'] + '</td><td>' + returnData[i]['desgination'] + '</td><td>'+ returnData[i]['start_date'] +'</td><td>'+ returnData[i]['end_date'] +'</td><td>'+ returnData[i]['leavereason'] + '</td><td><button class="btn btn-danger btn-sm delete-work-history" data-id="' + returnData[i]['id'] + '">Delete</button></td></tr>';
                        }
                        console.log(casestr);       
                        $("#workdetailstable").append(casestr);
                    }
                },
                error: function(response) {
                    alert("Something went wrong.");
                }
            })
        }
    })

    $(document).on('click', '.delete-skill', function(){
        $id = $(this).data('id');
        if (confirm("Are you sure you want to delete this skill?")) {
            $.ajax({
                url: "{{ route('staff.skill.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $id,
                    staff_id: <?= $staff->id ?>
                },
                success: function(response) {
                    $("#skillsettable").empty();
                    var returnData = response.data;
                    if(returnData.length > 0){
                        let casestr = '';
                        for(i=0;i<returnData.length;i++){
                            casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + returnData[i]['skill_name'] + '</td><td>' + returnData[i]['proficiency_level'] +'</td><td><button class="btn btn-danger btn-sm delete-skill" data-id="' + returnData[i]['id'] + '">Delete</button></td></tr>';
                        }
                        console.log(casestr);       
                        $("#skillsettable").append(casestr);
                    }
                },
                error: function(response) {
                    alert("Something went wrong.");
                }
            })
        }
    })

    $(document).on('click', '.delete-doc', function(){
        $id = $(this).data('id');
        if (confirm("Are you sure you want to delete this document?")) {
            $.ajax({
                url: "{{ route('staff.doc.delete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $id,
                    staff_id: <?= $staff->id ?>
                },
                success: function(response) {
                    $("#uploadfilestable").empty();
                    var returnData = response.data;
                    if(returnData.length > 0){
                        let casestr = '';
                        for(i=0;i<returnData.length;i++){
                            casestr  += `
                            <tr>
                                <td>${i + 1}</td>
                                <td>${returnData[i]['document_name']}</td>
                                <td><a href="/storage/${returnData[i]['file_path']}" target="_blank">View File</a></td>
                                <td><button class="btn btn-danger btn-sm delete-doc" data-id="${returnData[i]['id']}">Delete</button></td>
                            </tr>`;
                        }
                        console.log(casestr);       
                        $("#uploadfilestable").append(casestr);
                    }
                },
                error: function(response) {
                    alert("Something went wrong.");
                }
            })
        }
    })

    function readURL(input) {
		if (input.files && input.files[0]) {
			$.each(input.files, function() {
				var reader = new FileReader();
				reader.onload = function (e) {           
					$images.html('<img src="'+ e.target.result+'" />')
				}
				reader.readAsDataURL(this);
			});
		}
   	}
   
   	$("#departmentid").change(function(e){
    	e.preventDefault();   
   		var departmentid = $(this).val();
		$.ajax({
			type:'POST',
			url:"{{ route('staff.getroleusingdepid') }}",
			dataType: 'json',
			data:{ "_token": "{{ csrf_token() }}", "departmentid" :departmentid},
			success:function(response){  
				$("#roleid").empty();   
				var returnData = response;   
				if(returnData.length>0)
				{
					let casestr = '<option>Select Roles</option>';
					for(i=0;i<returnData.length;i++)
					{
						casestr  += '<option value = "' + returnData[i]['id'] + ' ">' + returnData[i]['rolename'] + '</option>';
					}
					console.log(casestr);       
					$("#roleid").append(casestr);
				}
				else
				{
					alert("No Data")
				}
			}
		});
	});
   
   
   	$(".staffdetails").click(function(){
		var first_name = $("#first_name").val();
		var last_name = $("#last_name").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		var contact_address = $("#contact_address").val();
		var location = $("#location").val();
		var date_of_birth = $("#date_of_birth").val();
		var hire_date = $("#hire_date").val();
		var roleid = $("#roleid").val();
		var departmentid = $("#departmentid").val();
		var supervisor_id = $("#supervisor_id").val();
   
     	$.ajax({
			type:'POST',
			url:"{{ route('staff.ajaxupdate') }}",
			dataType: 'json',
			data:{ "_token": "{{ csrf_token() }}", "staff_id": <?= $staff->id ?>, "first_name" :first_name, "last_name" :last_name, "email" :email, "phone" :phone, "contact_address" :contact_address, "location" :location, "date_of_birth" :date_of_birth,"hire_date" :hire_date,"roleid" :roleid,"departmentid" :departmentid,"supervisor_id" :supervisor_id},
     		success:function(response){  
      			if(response['status'] == 'success'){
                    $('#staffid').val(response['id']);
                    $('.nav-pills .active').parent().next('li').find('a').tab('show');
                }
            },
          	error: function(response) {
            	console.log(response);
   				var errors = response.responseJSON.errors;
   				console.log(errors);
   	 			$('.failmessage').css('display','none');
               	$.each( response.responseJSON.errors, function( key, value ) {
					console.log(key + " :  " +value);
					$('.'+key).css('display','block');
					$('.'+key).html(value);
               });
   			}
   		});
   	});
   
   	$(".savedegree").click(function(){
		$('.nav-pills .active').parent().next('li').find('a').tab('show');
	});
	
	$(".saveworking").click(function(){
		$('.nav-pills .active').parent().next('li').find('a').tab('show');
	});
	
	$(".savedocs").click(function(){
		$('.nav-pills .active').parent().next('li').find('a').tab('show');
	});
	
	$(".saveskills").click(function(){
		$('.nav-pills .active').parent().next('li').find('a').tab('show');
	});
   
   	$(".addqualification").click(function(){
		var degreename = $('#degreename').val();
		var qualification_type = $('#qualification_type').val();
		var institution = $('#institution').val(); 
		var completion_date = $('#completion_date').val(); 
		var staffid = $('#staffid').val(); 

   		$.ajax({
			type:'POST',
			url:"{{ route('staff.ajaxqualification') }}",
			dataType: 'json',
			data:{ "_token": "{{ csrf_token() }}", "degreename" :degreename, "qualification_type" :qualification_type, "institution" :institution, "completion_date" :completion_date,"staffid":staffid},
     		success:function(response){
   				$("#qualificationtable").empty();  
   				var returnData = response['details'];   
             	if(returnData.length > 0){
                 	let casestr = '';
                 	for(i=0;i<returnData.length;i++){
                     	casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + returnData[i]['degreename'] + '</td><td>' + returnData[i]['qualification_type'] + '</td><td>'+ returnData[i]['institution'] +'</td><td>'+ returnData[i]['completion_date'] + '</td><td><button class="btn btn-danger btn-sm delete-qualification" data-id="' + returnData[i]['id'] + '">Delete</button></td></tr>';
                 	}
					console.log(casestr);
					$("#qualificationtable").append(casestr);
             	}
             	else{
                	alert("No Data")
             	}
     		},
          	error: function(response) {
             	console.log(response);
   				var errors = response.responseJSON.errors;
   				console.log(errors);
   	 			$('.failmessage').css('display','none');
               	$.each( response.responseJSON.errors, function( key, value ) {
					console.log(key + " :  " +value);
					$('.'+key).css('display','block');
					$('.'+key).html(value);
               	});
   			}	
     	});
   	});
   
   	$("#addworkingdetails").click(function(){
		var employeername = $('#employeername').val();
		var desgination = $('#desgination').val();
		var start_date = $('#start_date').val(); 
		var end_date = $('#end_date').val(); 
		var leavereason = $('#leavereason').val(); 
		var staffid = $('#staffid').val(); 
		
   		$.ajax({
			type:'POST',
			url:"{{ route('staff.ajaxworkingdetails') }}",
			dataType: 'json',
			data:{ "_token": "{{ csrf_token() }}", "employeername" :employeername, "desgination" :desgination, "start_date" :start_date, "end_date" :end_date,"leavereason" :leavereason,"staffid":staffid},
     		success:function(response){
   				$("#workdetailstable").empty();  
   				var returnData = response['details'];   
             	if(returnData.length > 0){
                 	let casestr = '';
                 	for(i=0;i<returnData.length;i++){
                     	casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + returnData[i]['employeername'] + '</td><td>' + returnData[i]['desgination'] + '</td><td>'+ returnData[i]['start_date'] +'</td><td>'+ returnData[i]['end_date'] +'</td><td>'+ returnData[i]['leavereason'] + '</td></tr>';
                 	}
              		console.log(casestr);       
              		$("#workdetailstable").append(casestr);
             	}
             	else{
                	alert("No Data")
             	}
     		},
          	error: function(response) {
             	console.log(response);
   				var errors = response.responseJSON.errors;
   				console.log(errors);
   	 			$('.failmessage').css('display','none');
               	$.each( response.responseJSON.errors, function( key, value ) {
                 	console.log(key + " :  " +value);
                  	$('.'+key).css('display','block');
                  	$('.'+key).html(value);
               	});   	
   			}	
     	});
   });
   
   	$("#addskillset").click(function(){
		var skill_name = $('#skill_name').val();
		var proficiency_level = $('#proficiency_level').val();
   		var staffid = $('#staffid').val(); 
   
   		$.ajax({
			type:'POST',
			url:"{{ route('staff.ajaxskillset') }}",
			dataType: 'json',
			data:{ "_token": "{{ csrf_token() }}", "skill_name" :skill_name, "proficiency_level" :proficiency_level,"staffid":staffid},
     		success:function(response){
   				$("#skillsettable").empty();  
   				var returnData = response['details'];   
             	if(returnData.length > 0){
                 	let casestr = '';
                 	for(i=0;i<returnData.length;i++){
                     	casestr  += '<tr><td>' + (parseInt(i)+1) +'</td><td>' + returnData[i]['skill_name'] + '</td><td>' + returnData[i]['proficiency_level'] +'</td></tr>';
                 	}
             		console.log(casestr);
              		$("#skillsettable").append(casestr);
             	}
             	else{
                 	alert("No Data")
             	}
     		},
          	error: function(response) {
             	console.log(response);
   				var errors = response.responseJSON.errors;
   				console.log(errors);
   	 			$('.failmessage').css('display','none');
               	$.each( response.responseJSON.errors, function( key, value ) {
					console.log(key + " :  " +value);
					$('.'+key).css('display','block');
					$('.'+key).html(value);
               });
			}	
     	});
   	});
      
   	$("#uploadimage").click(function(){
		var staffid = $('#staffid').val(); 
		var staff_photo = $('#formFile')[0].files[0];

        if (!staff_photo) {
            alert("Please select an image before uploading.");
            return;
        }

        var formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("staff_photo", staff_photo);
        formData.append("staffid", staffid);

        $.ajax({
			type:'POST',
			url:"{{ route('staff.ajaxphotoadd') }}",
			dataType: 'json',
            data: formData,
            contentType: false,
            processData: false, 
			success:function(response){
				alert("Image added successfully");
			},
			error: function(response) {
			}
		});
   	});
   
    $(".uploadfiles").click(function(){
        var staffid = $('#staffid').val(); 
        var document_name = $('#document_name').val(); 
        var file_path = $('#file_path')[0].files[0];

        if (!file_path) {
            alert("Please select a file before uploading.");
            return;
        }
        var formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("file_path", file_path);
        formData.append("staffid", staffid);
        formData.append("document_name", document_name);
        var fileURL = URL.createObjectURL(file_path);

        $.ajax({
            type: 'POST',
            url: "{{ route('staff.ajaxdocuments') }}",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response){
                $("#uploadfilestable").empty();  
                var returnData = response['details'];   

                if(returnData.length > 0){
                    let casestr = '';
                    for(let i = 0; i < returnData.length; i++){
                        casestr += `<tr>
                            <td>${i + 1}</td>
                            <td>${returnData[i]['document_name']}</td>
                            <td><a href="/storage/${returnData[i]['file_path']}" target="_blank">View File</a></td>
                        </tr>`;
                    }
                    console.log(casestr);       
                    $("#uploadfilestable").append(casestr);
                } else {
                    alert("No Data");
                }
            },
            error: function(response) {
                alert("Error uploading file.");
            }
        });
    });

</script>
@endpush