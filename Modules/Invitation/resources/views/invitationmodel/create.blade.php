@extends('admin.layouts.app-admin')
@section('content')


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Invitation Model</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('invitation/invitationmodel') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Invitation Model List
                           </a>
                       </div>
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('invitationmodel.model_add') }}">
                                        @csrf
                                        <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="modelname">Invitation Card Model Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="modelname" name="modelname" class="form-control" placeholder="Enter the Model name" value = "{{ old('modelname') }}" required>
                                                @if($errors->has('modelname'))
                                                <div class="text-danger">{{ $errors->first('modelname') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>
                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Invitation Model</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
