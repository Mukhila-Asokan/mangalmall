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
                        <h4 class="header-title mb-4">Update Invitation Model</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('invitation/invitationmodel') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Event List
                           </a>
                       </div>
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('invitationmodel.update') }}">
                                        @csrf
                                         <input type="hidden" name="id" value="{{ $invitationmodel->id }}">
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="modelname">Invitation Card Model Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="modelname" name="modelname" class="form-control" placeholder="Enter the Model name" value = "{{ $invitationmodel->modelname }}" required>
                                                @if($errors->has('modelname'))
                                                <div class="text-danger">{{ $errors->first('modelname') }}</div>
                                                
                                            @endif
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
