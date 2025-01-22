
<?php $__env->startSection('content'); ?>
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
            <h4 class="header-title mb-4">Add <?php echo $pagetitle; ?></h4>
           
    <div class="text-end">
        <a href = "<?php echo e(route('staff/departments')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span> Staff List
        </a>
    </div>
  

    <ul class="nav nav-pills navtab-bg nav-justified">
        <li class="nav-item">
            <a href="#profiledetails" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                <span class="d-none d-sm-inline-block">Profile Details</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#qualification" data-bs-toggle="tab" aria-expanded="true" class="nav-link navqualification">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-account"></i></span>
                <span class="d-none d-sm-inline-block">Qualification</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#workhistory" data-bs-toggle="tab" aria-expanded="false" class="nav-link navworkhistory">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-email-variant"></i></span>
                <span class="d-none d-sm-inline-block">Work History</span>
            </a>
        </li>
		<li class="nav-item">
            <a href="#skillset" data-bs-toggle="tab" aria-expanded="false" class="nav-link navskillset">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                <span class="d-none d-sm-inline-block">Skill Set</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#docs" data-bs-toggle="tab" aria-expanded="false" class="nav-link navdocs">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                <span class="d-none d-sm-inline-block">Upload Docs & Photos</span>
            </a>
        </li> 
		<li class="nav-item">
            <a href="#contact" data-bs-toggle="tab" aria-expanded="false" class="nav-link navContact">
                <span class="d-inline-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                <span class="d-none d-sm-inline-block">Emergency Contact</span>
            </a>
        </li>
		
		
    </ul>
    <!-- Profile details -->
<div class="tab-content">
   <div class="tab-pane show active" id="profiledetails">
   <div class ="row">
   <div class="col-6">
   <div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="first_name">First Name</label>
        <div class="col-md-8">
                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter the First name" value = "<?php echo e(old('first_name')); ?>" required>
            
			  <div class="alert alert-danger failmessage first_name mt-3" style="display:none"></div>
        </div>

    </div>
    <div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="last_name">Last Name</label>
        <div class="col-md-8">
                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter the Last name" value = "<?php echo e(old('last_name')); ?>" required>
                <div class="alert alert-danger failmessage last_name mt-3" style="display:none"></div>
        </div>

    </div>
	
	 <div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="contact_address">Contact Address</label>
        <div class="col-md-8">
                <textarea type="text" id="contact_address" name="contact_address" class="form-control" placeholder="Enter the Contact Address" required><?php echo e(old('contact_address')); ?></textarea>
               <div class="alert alert-danger failmessage contact_address mt-3" style="display:none"></div>
        </div>

    </div>
	
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="date_of_birth">Date of Birth</label>
        <div class="col-md-8">
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value = "<?php echo e(old('date_of_birth')); ?>" required>
               <div class="alert alert-danger failmessage date_of_birth mt-3" style="display:none"></div>
        </div>

    </div>
	
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="hire_date">Hire Date</label>
        <div class="col-md-8">
                <input type="date" id="hire_date" name="hire_date" class="form-control" value = "<?php echo e(old('hire_date')); ?>" required>
              <div class="alert alert-danger failmessage hire_date mt-3" style="display:none"></div>
        </div>

    </div>
	
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="email">Reporting</label>
        <div class="col-md-8">
                <select id="supervisor_id" name="supervisor_id" class="form-control" >
					<option value= "">Select</option>
					<?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($st->id); ?>"> <?php echo e($st->first_name); ?> <?php echo e($st->last_name); ?>  </option> 
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="alert alert-danger failmessage supervisor_id mt-3" style="display:none"></div>
        </div>

    </div>
	
  </div>
    <div class="col-6">
	 <div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="email">Email ID</label>
        <div class="col-md-8">
                <input type="text" id="email" name="email" class="form-control" placeholder="Enter the Email Id" value = "<?php echo e(old('email')); ?>" required>
               
        </div>

    </div>
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="phone">Mobile No</label>
        <div class="col-md-8">
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter the Mobile No" value = "<?php echo e(old('phone')); ?>" required>
                <div class="alert alert-danger failmessage phone mt-3" style="display:none"></div>
        </div>

    </div>
	
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="location">Location</label>
        <div class="col-md-8">
                <input type="text" id="location" name="location" class="form-control" placeholder="Enter the Location" value = "<?php echo e(old('location')); ?>" required>
                <div class="alert alert-danger failmessage location mt-3" style="display:none"></div>
        </div>

    </div>
	<br>
	
	   <div class="mb-4 row">
			<label class="col-md-4 col-form-label" for="departmentname">Department</label>
			<div class="col-md-8">
				  <select id="departmentid" name="departmentid" class="form-control" >
					<option value ="">Select Department</option>
					<?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($dept->id); ?>"> <?php echo e($dept->departmentname); ?></option> 
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				 <div class="alert alert-danger failmessage departmentid mt-3" style="display:none"></div>
</div>

        </div>
		
		   <div class="mb-4 row">
			<label class="col-md-4 col-form-label" for="departmentname">Role</label>
			<div class="col-md-8">
				  <select id="roleid" name="roleid" class="form-control" >
					<option  value ="">Select Role</option>
				
				</select>
				 <div class="alert alert-danger failmessage roleid mt-3" style="display:none"></div>
</div>

        </div>
		
		<div class="justify-content-end row">
			<div class="col-sm-6">
				<button type="button" class="btn btn-primary waves-effect waves-light staffdetails">Save & Continue</button>	
				
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
                <input type="text" id="degreename" name="degreename" class="form-control" placeholder="Enter the Degree name" value = "<?php echo e(old('degreename')); ?>" required>
                 <div class="alert alert-danger failmessage degreename mt-3" style="display:none"></div>
        </div>

    </div>
	<br>
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="qualification_type">Field of Study</label>
        <div class="col-md-8">
                <input type="text" id="qualification_type" name="qualification_type" class="form-control" placeholder="Enter the Field of Study" value = "<?php echo e(old('qualification_type')); ?>" required>
               <div class="alert alert-danger failmessage qualification_type mt-3" style="display:none"></div>
        </div>

    </div>
	
		
	</div>
	
	 <div class="col-6">
	 
		<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="institution">Institution Name</label>
        <div class="col-md-8">
             <textarea type="text" id="institution" name="institution" class="form-control" required><?php echo e(old('institution')); ?></textarea>
             <div class="alert alert-danger failmessage institution mt-3" style="display:none"></div>
        </div>
		</div>
		
		
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="completion_date">Completion Date</label>
        <div class="col-md-8">
                <input type="date" id="completion_date" name="completion_date" class="form-control" value = "<?php echo e(old('completion_date')); ?>" required>
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
				<button type="button" class="btn btn-primary waves-effect waves-light savedegree">Save & Continue</button>	
			
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
              <textarea type="text" id="employeername" name="employeername" class="form-control" value = "<?php echo e(old('employeername')); ?>" required></textarea>
              <div class="alert alert-danger failmessage employeername mt-3" style="display:none"></div>
        </div>

    </div>
	<br>
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="desgination">Designation</label>
        <div class="col-md-8">
                <input type="text" id="desgination" name="desgination" class="form-control" placeholder="Enter the Field of Study" value = "<?php echo e(old('desgination')); ?>" required>
                <div class="alert alert-danger failmessage desgination mt-3" style="display:none"></div>
        </div>

    </div>
	
		
	</div>
	
	 <div class="col-6">
	 
		<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="start_date">Start Date</label>
        <div class="col-md-8">
                <input type="date" id="start_date" name="start_date" class="form-control" value = "<?php echo e(old('start_date')); ?>" required>
                <div class="alert alert-danger failmessage start_date mt-3" style="display:none"></div>
        </div>
		</div>
		
		
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="end_date">End Date</label>
        <div class="col-md-8">
                <input type="date" id="end_date" name="end_date" class="form-control" value = "<?php echo e(old('end_date')); ?>" required>
                <div class="alert alert-danger failmessage end_date mt-3" style="display:none"></div>
        </div>

    </div>
	<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="leavereason">Reason for Leave</label>
        <div class="col-md-8">
                <textarea type="text" id="leavereason" name="leavereason" class="form-control" value = "<?php echo e(old('leavereason')); ?>" required></textarea>
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
				<button type="button" class="btn btn-primary waves-effect waves-light saveworking">Save & Continue</button>	
			
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
            <input type="text" id="skill_name" name="skill_name" class="form-control" placeholder="Enter the Field of Study" value = "<?php echo e(old('skill_name')); ?>" required>
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
				<button type="button" class="btn btn-primary waves-effect waves-light saveskills">Save & Continue</button>	
			
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
	<div id = "categoryiconimage" class="imageOutput" style="width:200px;height:200px;border:1px solid #333"></div>
	<br>
	<div class="justify-content-end row mb-4">
			<div class="col-sm-6">
				<button type="button" class="btn btn-primary waves-effect waves-light" id="uploadimage">Upload Image</button>	
			
			</div>
			
		</div>
	
	</div>
	</div>
	<br>
	<div class="row">
		<div class="col-6">			
			<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="document_name">Document Name</label>
        <div class="col-md-8">
                <input type="text" id="document_name" name="document_name" class="form-control" value = "<?php echo e(old('document_name')); ?>" required>
                <div class="alert alert-danger failmessage document_name mt-3" style="display:none"></div>
        </div>

		</div>	
		</div>
		<div class="col-6">			
			<div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="file_path">Uplaod File</label>
        <div class="col-md-8">
                <input type="file" id="file_path" name="file_path" class="form-control" value = "<?php echo e(old('file_path')); ?>" required>
               <div class="alert alert-danger failmessage file_path mt-3" style="display:none"></div>
        </div>

		</div>	
		</div>
		
	</div>
	
		<div class="row mt-3">
		<div class="justify-content-end row">
			<div class="col-sm-2">
				<button type="button" class="btn btn-primary waves-effect waves-light uploadfiles"> <span class="tf-icon mdi mdi-plus me-1"></span> Add</button>	
			
			</div>
			
		</div>
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
				<button type="button" class="btn btn-primary waves-effect waves-light savedocs">Save & Continue</button>	
			
			</div>
			
		</div>
</div>
	
	

</div>

<div class="tab-pane" id="contact">
	<form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('staff.staff_add')); ?>">
        <?php echo csrf_field(); ?>
		
		<input type = "hidden" name = "staffid" id ="staffid" value = "" />
	<div class ="row">
	<div class="col-6">	
		<div class="mb-4 row">
			<label class="col-md-4 col-form-label" for="personname">Person Name</label>
			<div class="col-md-8">
					<input type="text" id="personname" name="personname" class="form-control" placeholder="Enter the Person Name" value = "<?php echo e(old('personname')); ?>" required>
					<div class="alert alert-danger failmessage personname mt-3" style="display:none"></div>
			</div>

		</div>
		<div class="mb-4 row">
			<label class="col-md-4 col-form-label" for="mobileno">Mobile No</label>
			<div class="col-md-8">
					<input type="text" id="mobileno" name="mobileno" class="form-control" placeholder="Enter the Mobile No" value = "<?php echo e(old('mobileno')); ?>" required>
					<div class="alert alert-danger failmessage mobileno mt-3" style="display:none"></div>
			</div>

		</div>
	</div>
	<div class="col-6">	
	   <div class="mb-4 row">
        <label class="col-md-4 col-form-label" for="address">Contact Address</label>
        <div class="col-md-8">
                <textarea type="text" id="address" name="address" class="form-control" placeholder="Enter the Contact Address" required><?php echo e(old('address')); ?></textarea>
               <div class="alert alert-danger failmessage address mt-3" style="display:none"></div>
        </div>

		</div>
		
		<div class="mb-4 row">
			<label class="col-md-4 col-form-label" for="relationship">Relationship</label>
			<div class="col-md-8">
					<input type="text" id="relationship" name="relationship" class="form-control" placeholder="Enter the relationship" value = "<?php echo e(old('relationship')); ?>" required>
					<div class="alert alert-danger failmessage relationship mt-3" style="display:none"></div>
			</div>

		</div>
		
	</div>
	</div>
	
	<div class="row mt-3">
		<div class="justify-content-end row">
			<div class="col-sm-2">
				<button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>	
			
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">

  $images = $('#categoryiconimage')
    $(".imageUpload").change(function(event){
        readURL(this);
       
    });
 
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
           url:"<?php echo e(route('staff.getroleusingdepid')); ?>",
           dataType: 'json',
           data:{ "_token": "<?php echo e(csrf_token()); ?>", "departmentid" :departmentid},
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
	   url:"<?php echo e(route('staff.ajaxstore')); ?>",
	   dataType: 'json',
	   data:{ "_token": "<?php echo e(csrf_token()); ?>", "first_name" :first_name, "last_name" :last_name, "email" :email, "phone" :phone, "contact_address" :contact_address, "location" :location, "date_of_birth" :date_of_birth,"hire_date" :hire_date,"roleid" :roleid,"departmentid" :departmentid,"supervisor_id" :supervisor_id},
	   success:function(response){  
		
			
			console.log(response);
			
			$('#staffid').val(response['id']);
			 $('.nav-pills .active').parent().next('li').find('a').trigger('click');
		
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
	alert("ha");
	 $('.nav-pills .active').parent().next('li').find('a').trigger('click');
	
});

$(".saveworking").click(function(){
	 $('.nav-pills .active').parent().next('li').find('a').trigger('click');
});

$(".savedocs").click(function(){
	 $('.nav-pills .active').parent().next('li').find('a').trigger('click');
});

$(".saveskills").click(function(){
	 $('.nav-pills .active').parent().next('li').find('a').trigger('click');
});



$(".addqualification").click(function(){
	
	var degreename = $('#degreename').val();
	var qualification_type = $('#qualification_type').val();
	var institution = $('#institution').val(); 
	var completion_date = $('#completion_date').val(); 
	var staffid = $('#staffid').val(); 
	
	 $.ajax({
	   type:'POST',
	   url:"<?php echo e(route('staff.ajaxqualification')); ?>",
	   dataType: 'json',
	   data:{ "_token": "<?php echo e(csrf_token()); ?>", "degreename" :degreename, "qualification_type" :qualification_type, "institution" :institution, "completion_date" :completion_date,"staffid":staffid},
	   success:function(response){
			$("#qualificationtable").empty();  
			var returnData = response['details'];   
            if(returnData.length>0)
            {
                let casestr = '';
                for(i=0;i<returnData.length;i++)
                {
                    casestr  += '<tr><td>' + i +'</td><td>' + returnData[i]['degreename'] + '</td><td>' + returnData[i]['qualification_type'] + '</td><td>'+ returnData[i]['institution'] +'</td><td>'+ returnData[i]['completion_date'] + '</td></tr>';
                }
             console.log(casestr);       
           
             $("#qualificationtable").append(casestr);
            }
            else
            {
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
	   url:"<?php echo e(route('staff.ajaxworkingdetails')); ?>",
	   dataType: 'json',
	   data:{ "_token": "<?php echo e(csrf_token()); ?>", "employeername" :employeername, "desgination" :desgination, "start_date" :start_date, "end_date" :end_date,"leavereason" :leavereason,"staffid":staffid},
	   success:function(response){
			$("#workdetailstable").empty();  
			var returnData = response['details'];   
            if(returnData.length>0)
            {
                let casestr = '';
                for(i=0;i<returnData.length;i++)
                {
                    casestr  += '<tr><td>' + i +'</td><td>' + returnData[i]['employeername'] + '</td><td>' + returnData[i]['desgination'] + '</td><td>'+ returnData[i]['start_date'] +'</td><td>'+ returnData[i]['end_date'] +  +'</td><td>'+ returnData[i]['leavereason'] + '</td></tr>';
                }
             console.log(casestr);       
           
             $("#workdetailstable").append(casestr);
            }
            else
            {
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
	   url:"<?php echo e(route('staff.ajaxskillset')); ?>",
	   dataType: 'json',
	   data:{ "_token": "<?php echo e(csrf_token()); ?>", "skill_name" :skill_name, "proficiency_level" :proficiency_level,"staffid":staffid},
	   success:function(response){
			$("#skillsettable").empty();  
			var returnData = response['details'];   
            if(returnData.length>0)
            {
                let casestr = '';
                for(i=0;i<returnData.length;i++)
                {
                    casestr  += '<tr><td>' + i +'</td><td>' + returnData[i]['skill_name'] + '</td><td>' + returnData[i]['proficiency_level'] +'</td></tr>';
                }
             console.log(casestr);       
           
             $("#skillsettable").append(casestr);
            }
            else
            {
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
	var staff_photo = $('#formFile').prop('files'); 
	
	
	
	$.ajax({
	   type:'POST',
	   url:"<?php echo e(route('staff.ajaxphotoadd')); ?>",
	   dataType: 'json',
	   data:{ "_token": "<?php echo e(csrf_token()); ?>", "staff_photo" :staff_photo,"staffid":staffid},
	   success:function(response){
			alert("Image added successfully");
	   },
         error: function(response) {
		 }
	});
	

	

});


$("#uploadfiles").click(function(){
	
	var staffid = $('#staffid').val(); 
	var document_name = $('#document_name').val(); 
	var file_path = $('#file_path').prop('files'); 
	
	$.ajax({
	   type:'POST',
	   url:"<?php echo e(route('staff.ajaxdocuments')); ?>",
	   dataType: 'json',
	   data:{ "_token": "<?php echo e(csrf_token()); ?>", "file_path" :file_path,"staffid":staffid, "document_name":document_name },
	   success:function(response){
			$("#uploadfilestable").empty();  
			var returnData = response['details'];   
            if(returnData.length>0)
            {
                let casestr = '';
                for(i=0;i<returnData.length;i++)
                {
                    casestr  += '<tr><td>' + i +'</td><td>' + returnData[i]['document_name'] + '</td><td>' + returnData[i]['file_path'] +'</td></tr>';
                }
             console.log(casestr);       
           
             $("#uploadfilestable").append(casestr);
            }
            else
            {
                alert("No Data")
            }
	   },
         error: function(response) {
		 }
	});
	
	
});




</script>



<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/StaffManagement\resources/views/staff/create.blade.php ENDPATH**/ ?>