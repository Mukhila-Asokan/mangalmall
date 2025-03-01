@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Subscription Plan</h4>
            
            <div class="text-end">
                <a href = "{{ route('subcriptionplan') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Subscription Plan List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('subcriptionplan.plan_add') }}">
            @csrf
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="name">Name</label>
                <div class="col-md-8">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter the plan name" value = "{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="description">Description</label>
                <div class="col-md-8">
                        <textarea id="description" name="description" class="form-control" placeholder="Enter the plan description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="price">Price</label>
                <div class="col-md-8">
                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter the plan price" value = "{{ old('price') }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="duration">Duration</label>
                <div class="col-md-8">
                        <input type="text" id="duration" name="duration" class="form-control" placeholder="Enter the plan duration" value = "{{ old('duration') }}">
                        @error('duration')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Subscription Plan</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection