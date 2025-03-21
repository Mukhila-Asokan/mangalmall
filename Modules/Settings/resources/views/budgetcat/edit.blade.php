@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit Budget Category</h4>
            
            <div class="text-end">
                <a href="{{ route('admin.budgetcat.index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-eye me-1"></span>Budget Category
                </a>
            </div>
        <form class="form-horizontal" role="form" method="post" action="{{ route('admin.budgetcat.update', $budgetCategory->id) }}">
            @csrf
            @method('PUT')
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="name">Budget Category Name</label>
                <div class="col-md-8">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter the Budget Category name" value="{{ old('name', $budgetCategory->name) }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="icon">Icon</label>
                <div class="col-md-8">
                    <input type="text" id="icon" name="icon" class="form-control" placeholder="Enter the icon class" value="{{ old('icon', $budgetCategory->icon) }}">
                    @error('icon')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="color">Color</label>
                <div class="col-md-8">
                    <input type="text" id="color" name="color" class="form-control" placeholder="Enter the color code" value="{{ old('color', $budgetCategory->color) }}">
                    @error('color')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Budget Category</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection