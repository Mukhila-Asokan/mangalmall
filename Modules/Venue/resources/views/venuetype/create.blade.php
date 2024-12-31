@extends('admin.layouts.app-admin')
@section('content')

<!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">{!! $pagetitle !!}</h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pageroot }}</a></li>
                        <li class="breadcrumb-item active">{!! $pagetitle !!}</li>
                    </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Venue Category List</h4>
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('admin.passwordupdate') }}">
                                        @csrf
                                        <div class="col-6">
                                        <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="venuetypename">Venue Type Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuetypename" name="venuetypename" class="form-control" placeholder="Enter the venue type name">
                                                @if($errors->has('venuetypename'))
                                                <div class="text-danger">{{ $errors->first('venuetypename') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>
                               
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
