@extends('admin.layouts.app-admin')
@section('content')

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Religion</h4>
                        <div class="row">
                           
                        <div class="text-end">
                         <a href = "{{ route('admin/religion') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method = "post" action="{{ route('religion.store') }}">
                        @csrf
                        <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="religionname">Religion Name</label>
                            <div class="col-md-8">
                                <input type="text" id="religionname" name="religionname" class="form-control" placeholder="Enter the Religion name" value = "{{ old('religionname') }}" >
                                @error('religionname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Religion</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection