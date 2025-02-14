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
                    <form class="form-horizontal" role="form" method = "post" action="{{ route('venue.district_add') }}">
                        @csrf
                        <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="districtname">District Name</label>
                            <div class="col-md-8">
                                <input type="text" id="districtname" name="districtname" class="form-control" placeholder="Enter the District name" value = "{{ old('districtname') }}" >
                                @error('districtname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
						
                        <br><br>
                       
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="statename">State Name</label>
                            <div class="col-md-8">
                                <select name="stateid" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($states as $sta)
                                    <option value="{{ $sta->id }}" {{ old('stateid') ==  $sta->id ? 'selected' : '' }} > {{$sta->statename  }}</option>
                                    @endforeach
                                </select>
                                @error('stateid')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        </div>
                        <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add District</button>
                                </div>
                            </div>
                     
                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
