@extends('venueadmin::layouts.admin-layout')
@section('content')
<div class="col-12 mt-3">
   <div class="card">
        <div class="card-header text-bg-primary">
            <h4 class="mb-0 text-white">Fill up the Staff details</h4>
        </div>
        <form class="form-horizontal p-3" role="form" method = "post" action="{{ route('venueadmin.store.staff') }}">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="first_name">First Name <span class="text-danger">*</span></label>
                    <input type="text" id="first_name" name="first_name" class="form-control " placeholder="Enter the first name" value = "{{ old('first_name') }}" #a32206>
                    @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="last_name">Last Name <span class="text-danger">*</span></label>
                    <input type="text" id="last_name" name="last_name" class="form-control " placeholder="Enter the last name" value = "{{ old('last_name') }}" #a32206>
                    @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="staff_code">Staff Code <span class="text-danger">*</span></label>
                    <input type="text" id="staff_code" name="staff_code" class="form-control " placeholder="Enter the staff code" value = "{{ old('staff_code') }}" #a32206>
                    @error('staff_code')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="mobile_number">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" id="mobile_number" name="mobile_number" class="form-control " placeholder="Enter the mobile number" value = "{{ old('mobile_number') }}" #a32206>
                    @error('mobile_number')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" class="form-control " placeholder="Enter the email" value = "{{ old('email') }}" #a32206>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="hired_date">Date of hired <span class="text-danger">*</span></label>
                    <input type="date" id="hired_date" name="hired_date" class="form-control" value = "{{ old('hired_date') }}" #a32206>
                    @error('hired_date')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="date_of_birth">Date of birth <span class="text-danger">*</span></label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value = "{{ old('date_of_birth') }}" #a32206>
                    @error('date_of_birth')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label class="col-md-4 col-form-label required" for="address">Address <span class="text-danger">*</span></label>
                    <textarea id="address" name="address" class="form-control">{{ old('address') }}</textarea>
                    @error('address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="justify-content-center d-flex mb-2 mt-3">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Staff </button>
            </div>
        </form>
    </div>
</div>
@endsection