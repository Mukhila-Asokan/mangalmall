@extends('admin.layouts.app-admin')
@section('content')


<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body">
        <h4 class="header-title mb-4">Add Roles</h4>
        
        <div class="text-end">
            <a href = "{{ route('staff/roles') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                            <span class="tf-icon mdi mdi-eye me-1"></span>Roles List
            </a>
        </div>
            <form class="form-horizontal" role="form" method = "post" action="{{ route('roles.role_add') }}">
                        @csrf
                        <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="rolename">Role Name</label>
                            <div class="col-md-8">
                                    <input type="text" id="rolename" name="rolename" class="form-control" placeholder="Enter the Role name" value = "{{ old('modelname') }}" required>
                                    @error('rolename')
                                       <div class="text-danger">{{ $message }}</div>
                                     @enderror
                            </div>

                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="departmentid">Department Name</label>
                            <div class="col-md-8">
                                <select id="departmentid" name="departmentid" class="form-control" >
                                    <option>Select Department</option>
                                    @foreach($department as $dept)
                                        <option value="{{ $dept->id }}"> {{ $dept->departmentname }}</option> 
                                    @endforeach
                                </select>
                                @error('departmentid')
                                       <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            </div>
                        <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Role</button>
                                </div>
                            </div>
                        </div>
                    </form>
    </div>
</div>
</div>
</div>
@endsection
