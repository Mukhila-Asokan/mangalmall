@extends('admin.layouts.app-admin')
@section('content')

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Venue Type</h4>
                        <div class="row">
                             <div class="col-6">
                                 <a href = "{{ route('admin/venuetype') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                           </a>
                             </div>
                        <div class="col-6 text-end">
                         <a href = "{{ route('venuetype/show') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method = "post" action="{{ route('venuetype.venuetype_add') }}">
                        @csrf
                        <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="venuetypename">Venue Type Name</label>
                            <div class="col-md-8">
                                <input type="text" id="venuetype_name" name="venuetype_name" class="form-control" placeholder="Enter the venue type name" value = "{{ old('venuetype_name') }}" >
                                @error('venuetype_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Venue Type</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
