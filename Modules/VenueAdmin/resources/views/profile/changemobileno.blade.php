@extends('venueadmin::layouts.admin-layout')
@section('content')

<form class="form-horizontal" role="form" method="post" action="{{ route('venueadmin.storeRequest') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="mobileno">Mobile No</label>
                    <div class="col-md-6">
                        <input type="text" id="new_mobile" name="new_mobile" class="form-control border border-warning" placeholder="Enter the new mobile number" value="{{ old('new_mobile') }}" required>
                        @error('new_mobile')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Send Request</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection