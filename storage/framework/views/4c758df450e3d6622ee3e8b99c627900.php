<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="header-title mb-4"><?php echo e($pagetitle); ?></h4>
			   
				<div class="text-end">
				 <a href = "<?php echo e(route('staff/profile')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
								  <span class="tf-icon mdi mdi-eye me-1"></span>Staff Profile
				   </a>
				</div>
    
                <div class="col-xl-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Staff Name - <?php echo e($staff->first_name); ?> <?php echo e($staff->last_name); ?></h4>

                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                      Profile
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
													<table class="table-bordered table">
                                                        <tbody>
														<tr><th>Email</th><td><?php echo e($staff->email); ?></td><td rowspan="10">Image</td>
														</tr>
                                                        <tr><th>Mobile</th><td><?php echo e($staff->phone); ?></td></tr>
                                                        <tr><th>Contact Address</th><td><?php echo e($staff->contact_address); ?></td></tr>
                                                        <tr><th>Location</th><td><?php echo e($staff->location); ?></td></tr>
                                                        <tr><th>Date of Birth</th><td><?php echo e($staff->date_of_birth); ?></td></tr>
                                                        <tr><th>Hiring Date</th><td><?php echo e($staff->hire_date); ?></td></tr>
                                                        <tr><th>Employee Code</th><td><?php echo e($staff->employee_code); ?></td></tr>
                                                        <tr><th>Role</th><td><?php echo e($staff->roleid); ?></td></tr>
                                                        <tr><th>Department</th><td><?php echo e($staff->departmentid); ?></td></tr>
                                                        <tr><th>Reporting</th><td><?php echo e($staff->supervisor_id); ?></td></tr>
														</tbody>
													</table>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        Qualification
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
													<table class="table-bordered table">
														<thead>
															<tr><td>#</td>
																<td>Degree</td>
																<td>Degree Type</td>
																<td>Institution</td>
																<td>Completion Date</td>
															</tr>
														</thead>
														<tbody>
														<?php
															$i=1;
														?>
															<?php $__currentLoopData = $staff_qualification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qualification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<tr>
																<td> <?php echo e($i++); ?></td>
																<td><?php echo e($qualification->degreename); ?></td>
																<td><?php echo e($qualification->qualification_type); ?></td>
																<td><?php echo e($qualification->institution); ?></td>
																<td><?php echo e($qualification->completion_date); ?></td>
															</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</tbody>
													</table>
													
													
													</div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                        Skill Set
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">	
													<table class="table-bordered table">
														<thead>
															<tr><td>#</td>
																<td>Skill Name</td>															
																<td>Proficiency Level</td>															
															</tr>
														</thead>
														<tbody>
														<?php
															$s=1;
														?>
															<?php $__currentLoopData = $staff_skill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<tr>
																<td> <?php echo e($s++); ?></td>
																<td><?php echo e($skill->skill_name); ?></td>
																<td><?php echo e($skill->proficiency_level); ?></td>																
															</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</tbody>
													</table>
													</div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                        Work History
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">  
													<table class="table-bordered table">
														<thead>
															<tr><td>#</td>
																<td>Company Name</td>															
																<td>Desingation</td>															
																<td>Start Date</td>															
																<td>End Date</td>															
																<td>Reason for Leave</td>															
															</tr>
														</thead>
														<tbody>
														<?php
															$s=1;
														?>
															<?php $__currentLoopData = $staff_work; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $work): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<tr>
																<td> <?php echo e($s++); ?></td>
																<td><?php echo e($work->employeername); ?></td>
																<td><?php echo e($work->desgination); ?></td>																
																<td><?php echo e($work->start_date); ?></td>																
																<td><?php echo e($work->end_date); ?></td>																
																<td><?php echo e($work->leavereason); ?></td>																
															</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</tbody>
													</table></div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                        Uploaded Documents
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
														
													<table class="table-bordered table">
														<thead>
															<tr><td>#</td>
																<td>Document Name</td>															
																<td>File Path</td>															
															</tr>
														</thead>
														<tbody>
														<?php
															$s=1;
														?>
															<?php $__currentLoopData = $staff_doc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<tr>
																<td> <?php echo e($s++); ?></td>
																<td><?php echo e($doc->document_name); ?></td>
																<td><?php echo e($doc->file_path); ?></td>																
															</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</tbody>
													</table>
													
													</div>
                                                </div>
                                            </div>
											 <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                                        Emergency Contacts
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body"> <table class="table-bordered table">
														<thead>
															<tr><td>#</td>
																<td>person Name</td>															
																<td>Mobile No</td>															
																<td>Address</td>															
																<td>Relationship</td>															
															</tr>
														</thead>
														<tbody>
														<?php
															$s=1;
														?>
															<?php $__currentLoopData = $staff_em; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $em): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<tr>
																<td> <?php echo e($s++); ?></td>
																<td><?php echo e($em->personname); ?></td>
																<td><?php echo e($em->mobileno); ?></td>																
																<td><?php echo e($em->address); ?></td>																
																<td><?php echo e($em->relationship); ?></td>																
															</tr>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</tbody>
													</table></div>
                                                </div>
                                            </div>
											
                                        </div>
                                        <!-- end accordion -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->

				 
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/StaffManagement\resources/views/staff/detailview.blade.php ENDPATH**/ ?>