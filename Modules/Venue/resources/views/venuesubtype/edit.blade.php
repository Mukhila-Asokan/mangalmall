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
                        <h4 class="header-title mb-4">Edit Venue Subtype</h4>

                           <div class="row">
                             <div class="col-6">
                                 <a href = "{{ route('admin/venuetype') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                           </a>
                             </div>
                        <div class="col-6 text-end">
                          <a href = "{{ route('venuesubtype/show') }}" class="btn btn-primary waves-effect waves-light">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                    </div>
                        

                        

                          <form class="form-horizontal" role="form" method = "post" action="{{ route('venuesubtype.update') }}">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $venuetype->id }}">
                                        <input type="hidden" name="_method" value="PUT">

                                        <div class="col-6">

                                         <div class="mb-4 row">
                                              <label class="col-md-4 col-form-label" for="venuetypename">Select Venue Type</label>
                                               <div class="col-md-8">
                                             <select class="form-select" id="roottype" name="roottype" aria-label="Floating label select example">
                                                <option selected>Open this Venue Type</option>

                                                @foreach($venuetypes as $type)
                                                    @php 

                                $value =  ($type->id == $venuetype->roottype) ? 'Selected' : '';  

                              @endphp
                                                <option value = "{{ $type->id }}" {{ $value }} >{{ $type->venuetype_name }} 
                                                </option>
                                                @endforeach
                                               </select>
                                                 @if($errors->has('venuetype_name'))
                                                <div class="text-danger">{{ $errors->first('venuetype_name') }}</div>
                                                
                                            @endif
                                            </div>

                                         </div>       

                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="venuetype_name">Venue Type Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="venuetype_name" name="venuetype_name" class="form-control" placeholder="Enter the venue type name" value = "{{ $venuetype->venuetype_name }}" required>
                                                @if($errors->has('venuetype_name'))
                                                <div class="text-danger">{{ $errors->first('venuetype_name') }}</div>
                                                
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
