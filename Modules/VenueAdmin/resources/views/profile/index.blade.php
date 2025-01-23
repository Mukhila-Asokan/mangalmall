@extends('venueadmin::layouts.admin-layout')
@section('content')

<form class="form-horizontal" role="form" method = "post" action="{{ route('venueadmin/userprofileupdate') }}" enctype="multipart/form-data">
                                        @csrf
<div class="col-12">
		<div class="card">
                <div class="card-body">
               
		 <div class="mb-4 row">
			<label class="col-md-2 col-form-label" for="refferance">Referred By </label>
			<div class="col-md-6">
					<select type="text" id="refferance" name="refferance" class="form-control border border-warning" value = "{{ old('refferance') }}" required>
							<option value = "">Select</option>
							@foreach($staff as $st)
								<option value = "{{ $st->id }}" {{ $venueuserprofile->refferanceid == $st->id ? 'Selected' : '' }}>{{ $st->first_name }} {{ $st->last_name }}</option>
							@endforeach
					</select>
				
				@error('refferance')
					<div class="text-danger">{{ $message }}</div>					
				@enderror
			</div>
		</div>      
		 <div class="mb-4 row">
			<label class="col-md-2 col-form-label" for="name">Name </label>
			<div class="col-md-6">
					 <input type="text" id="name" name="name" class="form-control border border-warning" placeholder="Enter the name" value = "{{ $venueuser->name }}" required>
                                               
				@error('name')
					<div class="text-danger">{{ $message }}</div>					
				@enderror
			</div>
		</div>
		<div class="mb-4 row">
			<label class="col-md-2 col-form-label" for="email">Email </label>
			<div class="col-md-6">
					 <input type="text" id="email" name="email" class="form-control border border-warning" placeholder="Enter the email" value = "{{ $venueuser->email }}" required>
                                               
				@error('email')
					<div class="text-danger">{{ $message }}</div>					
				@enderror
			</div>
		</div>
		<div class="mb-4 row">
			<label class="col-md-2 col-form-label" for="mobileno">Mobile No  </label>
			<div class="col-md-6">
					 <input type="text" id="mobileno" name="mobileno" class="form-control border border-warning" placeholder="Enter the Mobileno" value = "{{ $venueuser->mobileno }}" disabled>
                                               
				@error('mobileno')
					<div class="text-danger">{{ $message }}</div>					
				@enderror
			</div>
		</div>
		<div class="mb-4 row">
			<label class="col-md-2 col-form-label" for="city">City  </label>
			<div class="col-md-6">
					 <input type="text" id="city" name="city" class="form-control border border-warning" placeholder="Enter the city" value = "{{ $venueuser->city }}" required>
                                               
				@error('city')
					<div class="text-danger">{{ $message }}</div>					
				@enderror
			</div>
		</div>
		<div class="mb-4 row">
			<label class="col-md-2 col-form-label" for="city">Contact Address  </label>
			<div class="col-md-6">
				<textarea type="text" id="contact_address" name="contact_address" class="form-control border border-warning" value = "" required>{{ $venueuserprofile->contact_address ?? '' }}</textarea>         
				@error('contact_address')
					<div class="text-danger">{{ $message }}</div>					
				@enderror
			</div>
		</div>
		
			<br><br>
	 <div class="justify-content-end row">
			<div class="col-sm-9">
				<button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
			</div>
		</div>
		
</div>
</div>
</div>
</form>

@endsection