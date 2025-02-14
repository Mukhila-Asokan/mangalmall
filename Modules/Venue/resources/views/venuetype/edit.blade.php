@extends('admin.layouts.app-admin')
@section('content')

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Venue Type</h4>


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

                        
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('venuetype.update') }}">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $venuetype->id }}">
                                        <input type="hidden" name="_method" value="PUT">

                                        <div class="col-6">
                                        <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="venuetype_name">Venue Type Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuetype_name" name="venuetype_name" class="form-control" placeholder="Enter the venue type name" value = "{{ $venuetype->venuetype_name }}" required>
                                                  @error('venuetype_name')
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
