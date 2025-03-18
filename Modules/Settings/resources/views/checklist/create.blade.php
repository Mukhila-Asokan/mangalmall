@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Checklist</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.checklist') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Checklist List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('admin.checklist.store') }}">
            @csrf
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="name">Checklist Name</label>
                <div class="col-md-8">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter the Checklist name" value = "{{ old('checklistname') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>
        <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="maintitle">Main Title</label>
            <div class="col-md-8">
                <select id="maintitle" name="maintitle" class="form-control">
                    <option value="">Select Main Title</option>
                    <option value = "0">None</option>
                    @foreach($maintitles as $maintitle)
                        <option value="{{ $maintitle->id }}" {{ old('maintitle') == $maintitle->id ? 'selected' : '' }}>{{ $maintitle->name }}</option>
                    @endforeach
                </select>
                @error('maintitle')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="occasion">Occasion</label>
                <div class="col-md-8">
                    <select id="occasion" name="occasion" class="form-control">
                        <option value="">Select Occasion</option>
                        @foreach($occasions as $occasion)
                            <option value="{{ $occasion->id }}" {{ old('occasion') == $occasion->id ? 'selected' : '' }}>{{ $occasion->eventtypename }}</option>
                        @endforeach
                    </select>
                    @error('occasion')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Checklist</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection