@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit Budget Item</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.budgetitems.index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Budget Items
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('admin.budgetitems.update', $budgetItem->id) }}">
            @csrf
            @method('PUT')
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="name">Budget Item Name</label>
                <div class="col-md-8">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter the Budget Item name" value="{{ old('name', $budgetItem->name) }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="budget_category_id">Budget Category</label>
                <div class="col-md-8">
                    <select id="budget_category_id" name="budget_category_id" class="form-control">
                        <option value="">Select Budget Category</option>
                        @foreach($budgetCategories as $category)
                            <option value="{{ $category->id }}" {{ old('budget_category_id', $budgetItem->budget_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('budget_category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Budget Item</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection