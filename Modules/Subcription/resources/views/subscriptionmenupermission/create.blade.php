@extends('admin.layouts.app-admin')
@section('content')
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Subscription Menu Permission</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.subscriptionmenupermission') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Subscription Menu Permission List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('subscriptionmenupermission.permission_add') }}">
            @csrf
            <div class="col-12">
            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="menu_id">Menu</label>
                <div class="col-md-8">
                        <select id="menu_id" name="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            @foreach($usermenus as $usermenu)
                                <option value="{{ $usermenu->id }}" {{ old('menu_id') == $usermenu->id ? 'selected' : '' }}>{{ $usermenu->menuname }}</option>
                            @endforeach
                        </select>
                        @error('menu_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="subscriber_id">Subscriber Plan</label>
                <div class="col-md-8">
                        <select id="subscriber_id" name="subscriber_id" class="form-control">
                            <option value="">Select Subscriber Plan</option>
                            @foreach($subscriberplans as $subscriberplan)
                                <option value="{{ $subscriberplan->id }}" {{ old('subscriber_id') == $subscriberplan->id ? 'selected' : '' }}>{{ $subscriberplan->name }}</option>
                            @endforeach
                        </select>
                        @error('subscriber_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-2 col-form-label" for="access">Access</label>
                <div class="col-md-8">
                        <select id="access" name="access" class="form-control">
                            <option value="">Select Access</option>
                            <option value="Granted" {{ old('access') == 'Granted' ? 'selected' : '' }}>Granted</option>
                            <option value="Revoked" {{ old('access') == 'Revoked' ? 'selected' : '' }}>Revoked</option>
                        </select>
                        @error('access')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Subscription Menu Permission</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection