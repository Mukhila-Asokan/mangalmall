@extends('admin.layouts.app-admin')
@section('content')

<style type="text/css">
    .pointer {cursor: pointer;}

</style>
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4>Admin Profile</h4>
            <!-- <p class="sub-header"> User can change the password in this page</p> -->

                <div class="row">
                <div class="col-12">
                    <div class="p-2">
                        <form class="form-horizontal" role="form" method = "post" action="{{ route('admin/user/update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="col-6">
                                <div class="mb-2 row">
                                    <label class="col-md-4 col-form-label" for="name">Name</label>
                                    <input type="text" id="name" name = "name" class="form-control" value="{{ $user->name }}" required>
                                    @if($errors->has('oldpassword'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="mb-2 row">
                                    <label class="col-md-4 col-form-label" for="name">Email</label>
                                    <input type="email" id="email" name = "email" class="form-control" value="{{ $user->email }}" required>
                                    @if($errors->has('oldpassword'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                @if($staff)
                                <div class="mb-2 row">
                                    <label class="col-md-4 col-form-label" for="phone">Mobile Number</label>
                                    <input type="text" id="phone" name = "phone" class="form-control" value="{{ $staff->phone }}" required>
                                    @if($errors->has('oldpassword'))
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                @endif
                                <div class="mb-2 row">
                                    <label class="col-md-4 col-form-label" for="role">Role</label>
                                    <input type="text" id="role" name = "role" class="form-control" disabled value="{{ $user->role }}" required>
                                    @if($errors->has('oldpassword'))
                                        <div class="text-danger">{{ $errors->first('role') }}</div>
                                    @endif
                                </div>
                                <div class="justify-content-end row">
                                    <div class="col-sm-9">
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
</div>
@endsection