@extends('admin.layouts.app-admin')
@section('content')
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Occasion Data Field</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('admin/occasiondatafield') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>Occasion Data Fields List
                           </a>
                       </div>
                          <form class="form-horizontal" role="form" method = "post" action="{{ route('admin/occasiondatafield/store') }}">
                                        @csrf
                                        <div class="col-6">
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="occasion_id">Occasion Type Name</label>
                                            <div class="col-md-8">
                                                  <select id="occasion_id" name="occasion_id" class="form-control">
                                                      <option value="">Select Occasion Type</option>
                                                      @foreach($occasionTypes as $occasionType)
                                                          <option value="{{ $occasionType->id }}" {{ old('occasion_id') == $occasionType->id ? 'selected' : '' }}>{{ $occasionType->eventtypename }}</option>
                                                      @endforeach
                                                  </select>
                                                @error('occasion_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="datafieldname">Occasion Data Field Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="datafieldname" name="datafieldname" class="form-control" placeholder="Enter the Occasion Data Field name" value="{{ old('datafieldname') }}" >
                                                  @error('datafieldname')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="datafieldtype">Data Field Type</label>
                                            <div class="col-md-8">
                                                <select id="datafieldtype" name="datafieldtype" class="form-control">
                                                    <option value="">Select Data Field Type</option>                                                   
                                                    <option value="text" {{ old('datafieldtype') == 'text' ? 'selected' : '' }}>Text</option>
                                                    <option value="textarea" {{ old('datafieldtype') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                                </select>
                                                @error('datafieldtype')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Occasion Data Field</button>
                                                </div>
                                            </div>
                                        </div>
                                   
                                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection