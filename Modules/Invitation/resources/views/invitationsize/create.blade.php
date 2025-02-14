@extends('admin.layouts.app-admin')
@section('content')


<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Invitation Size</h4>
            
            <div class="text-end">
                <a href = "{{ route('invitation/invitationsize') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Inviation Size List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('invitation.size_add') }}">
            @csrf
            <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="sizename">Invitation Size Name</label>
                <div class="col-md-8">
                        <input type="text" id="sizename" name="sizename" class="form-control" placeholder="Enter the Size name" value = "{{ old('sizename') }}">
                        @error('sizename')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>

            </div>
            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Invitation Size</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection
