@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit Blog Category</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.blogcategory') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Blog Category List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('blogcategory.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="categoryname">Blog Category Name</label>
                <div class="col-md-8">
                        <input type="text" id="categoryname" name="categoryname" class="form-control" placeholder="Enter the Category name" value = "{{ old('categoryname', $category->categoryname) }}">
                        @error('categoryname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>

            </div>
            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Blog Category</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection