@extends('admin.layouts.app-admin')
@section('content')


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Merchandiser Model</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('merchandiser/merchandisermodel') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Merchandiser Model List
                           </a>
                       </div>
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('merchandiser.save') }}">
                                        @csrf
                                        <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="category_name">Merchandiser Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter the category name" value = "{{ old('category_name') }}" required>
                                                @if($errors->has('category_name'))
                                                <div class="text-danger">{{ $errors->first('category_name') }}</div>
                                                
                                            @endif
                                            </div>

                                        </div>
                                        
                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Merchandiser Model</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
