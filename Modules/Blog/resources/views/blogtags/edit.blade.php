@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Edit Blog Tag</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.blogtag') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Blog Tag List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('blogtag.update', $blogtag->id) }}">
            @csrf
            @method('PUT')

            @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="tagname">Blog Tag Name</label>
                <div class="col-md-8">
                        <input type="text" id="tagname" name="tagname" class="form-control" placeholder="Enter the Tag name" value = "{{ old('tagname', $blogtag->tagname) }}">
                        @error('tagname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>

            </div>
            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Blog Tag</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection