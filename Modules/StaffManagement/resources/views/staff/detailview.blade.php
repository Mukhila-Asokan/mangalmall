@extends('admin.layouts.app-admin')
@section('content')
<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <h4 class="header-title mb-4">{{ $pagetitle }}</h4>
            <div class="text-end">
				<a href = "{{ route('admin/list/venue/user', ['staffId' => $staff->id]) }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-eye me-1"></span>Venue User List
                </a>
				<a href ="{{ route('admin/create/venue/user', ['id' => $staff->id]) }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
					<span class="tf-icon mdi mdi-plus me-1"></span>Create Venue User
				</a>
				<a href ="{{ route('admin/staff') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
					<span class="tf-icon mdi mdi-eye me-1"></span> Staff List
				</a>
            </div>
            <div class="col-xl-10">
				<div class="card">
					<div class="card-body">
						<h4 class="header-title mb-3">Staff Name - {{ $staff->first_name }} {{ $staff->last_name }}</h4>
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
													<tr>
														<th>Email</th>
														<td>{{ $staff->email }}</td>
														<td rowspan="10">
															<div id ="categoryiconimage" class="imageOutput" style="width:200px;height:200px;border:1px solid #333">
																<img src="{{ asset('storage/' . $staff->staff_photo) }}" style="width:200px;height:200px;border:1px solid #333">
															</div>
														</td>
													</tr>
													<tr>
														<th>Mobile</th>
														<td>{{ $staff->phone }}</td>
													</tr>
													<tr>
														<th>Contact Address</th>
														<td>{{ $staff->contact_address }}</td>
													</tr>
													<tr>
														<th>Location</th>
														<td>{{ $staff->location }}</td>
													</tr>
													<tr>
														<th>Date of Birth</th>
														<td>{{ $staff->date_of_birth }}</td>
													</tr>
													<tr>
														<th>Hiring Date</th>
														<td>{{ $staff->hire_date }}</td>
													</tr>
													<tr>
														<th>Employee Code</th>
														<td>{{ $staff->employee_code }}</td>
													</tr>
													<tr>
														<th>Role</th>
														<td>{{ $staff->roleid }}</td>
													</tr>
													<tr>
														<th>Department</th>
														<td>{{ $staff->departmentid }}</td>
													</tr>
													<tr>
														<th>Reporting</th>
														<td>{{ $staff->supervisor_id }}</td>
													</tr>
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
													<tr>
														<td>#</td>
														<td>Degree</td>
														<td>Degree Type</td>
														<td>Institution</td>
														<td>Completion Date</td>
													</tr>
												</thead>
												<tbody>
													@php
														$i=1;
													@endphp
													@foreach($staff_qualification as $qualification)
														<tr>
															<td> {{  $i++ }}</td>
															<td>{{ $qualification->degreename }}</td>
															<td>{{ $qualification->qualification_type }}</td>
															<td>{{ $qualification->institution }}</td>
															<td>{{ $qualification->completion_date }}</td>
														</tr>
													@endforeach
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
												<tr>
													<td>#</td>
													<td>Skill Name</td>
													<td>Proficiency Level</td>
												</tr>
												</thead>
												<tbody>
													@php
														$s=1;
													@endphp
													@foreach($staff_skill as $skill)
														<tr>
															<td> {{  $s++ }}</td>
															<td>{{ $skill->skill_name }}</td>
															<td>{{ $skill->proficiency_level }}</td>
														</tr>
													@endforeach
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
													<tr>
														<td>#</td>
														<td>Company Name</td>
														<td>Desingation</td>
														<td>Start Date</td>
														<td>End Date</td>
														<td>Reason for Leave</td>
													</tr>
												</thead>
												<tbody>
													@php
														$s=1;
													@endphp
													@foreach($staff_work as $work)
														<tr>
															<td> {{  $s++ }}</td>
															<td>{{ $work->employeername }}</td>
															<td>{{ $work->desgination }}</td>
															<td>{{ $work->start_date }}</td>
															<td>{{ $work->end_date }}</td>
															<td>{{ $work->leavereason }}</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
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
													<tr>
														<td>#</td>
														<td>Document Name</td>
														<td>File Path</td>
													</tr>
												</thead>
												<tbody>
													@php
														$s=1;
													@endphp
													@foreach($staff_doc as $doc)
														<tr>
															<td> {{  $s++ }}</td>
															<td>{{ $doc->document_name }}</td>
															<td>{{ $doc->file_path }}</td>
														</tr>
													@endforeach
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
										<div class="accordion-body">
											<table class="table-bordered table">
												<thead>
													<tr>
														<td>#</td>
														<td>person Name</td>
														<td>Mobile No</td>
														<td>Address</td>
														<td>Relationship</td>
													</tr>
												</thead>
												<tbody>
													@php
														$s=1;
													@endphp
													@foreach($staff_em as $em )
														<tr>
															<td> {{  $s++ }}</td>
															<td>{{ $em->personname }}</td>
															<td>{{ $em->mobileno }}</td>
															<td>{{ $em->address }}</td>
															<td>{{ $em->relationship }}</td>
														</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<!-- end accordion -->
					</div>
				</div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection