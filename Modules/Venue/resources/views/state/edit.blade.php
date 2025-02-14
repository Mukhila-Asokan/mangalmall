@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add State</h4>
                        <div class="row">
                             <div class="col-6">
                                 <a href = "{{ route('venuesettings') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                           </a>
                             </div>
                        <div class="col-6 text-end">
                         <a href = "{{ route('venue.state') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                    </div>
         <form action="{{ route('state.update', $state->id) }}" method="POST">
             @csrf
            @method('PUT')
        
       

        <div class="col-6">
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="venuetypename">State Name</label>
                <div class="col-md-8">
                    <input type="text" id="statename" name="statename" class="form-control" placeholder="Enter the State name" value = "{{ $state->statename }}" >
                    @error('statename')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </div>
        </div>








    </form>
    </div>
                </div>
            </div>
        </div>
@endsection

