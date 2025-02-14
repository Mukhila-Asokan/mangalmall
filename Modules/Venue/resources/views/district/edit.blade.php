@extends('admin.layouts.app-admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Add District</h4>
                <div class="row">
                        <div class="col-6">
                            <a href = "{{ route('venuesettings') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                    </a>
                        </div>
                <div class="col-6 text-end">
                    <a href = "{{ route('venue.district') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-eye me-1"></span>View List
                    </a>
                </div>
            </div>
    <form action="{{ route('districts.update', $district->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="districtname">District Name</label>
                <div class="col-md-8">
            <input type="text" class="form-control" id="districtname" name="districtname" value="{{ $district->districtname }}" required>
            @error('districtname')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
         </div>
						
      

      <div class="mb-4 row">
            <label class="col-md-4 col-form-label" for="statename">State Name</label>
            <div class="col-md-8">
            <select class="form-control" id="stateid" name="stateid" required>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ $district->stateid == $state->id ? 'selected' : '' }}>{{ $state->statename }}</option>
                @endforeach
            </select>
            @error('stateid')
             <div class="text-danger">{{ $message }}</div>
             @enderror
             </div>
            </div>
            </div>
            <br>
            <div class="justify-content-end row">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update District</button>
                </div>
            </div>
    </form>
    <br>
    </div>
                </div>
            </div>
        </div>
@endsection