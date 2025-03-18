@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Checklist Item</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.checklistitems.index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Checklist Items
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('admin.checklistitems.store') }}">
            @csrf
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="category_id">Checklist Category</label>
                <div class="col-md-8">
                    <select id="category_id" name="category_id" class="form-control">
                            <option value = "">Select Checklist Category</option>
                        @foreach($checklist as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="item_name">Item Name</label>
                <div class="col-md-8">
                    <input type="text" id="item_name" name="item_name" class="form-control" placeholder="Enter the Item name" value = "{{ old('item_name') }}">
                    @error('item_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Checklist Item</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection