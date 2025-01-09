@extends('admin.layouts.app-admin')
@section('content')
<style type="text/css">
    table
    {
        color:#000;
    }
</style>

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
                        <h4 class="header-title mb-4">Venue List</h4>
                       
                        <div class="text-end">
                         <a href = "{{ route('venue/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-plus me-1"></span>Add Venue
                           </a>
                        </div>
                    
                     <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                           <div class="text-end">
                         <a href = "{{ route('venue/index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                           </a>
                        </div>
                        <div class="row">
                        <div class="col-12">
                              <div class="row row-cols-1 row-cols-md-3 g-3">
                            @foreach($theme as $row)
                              
                                    <div class="col">
                                        <div class="card">
                                    @php 

                                         $preview_imageurl = url("admin/venue/themebuilder/".$row->id."/preview");

                                          $url = url('/').Storage::url('/').$row->preview_image;
                                          $editorurl = url("admin/venue/themebuilder/".$venueid."/".$row->id."/editor");
                                    @endphp
                                    <a href ="{{ $preview_imageurl }}" target="_new"><img src = "{{ $url }}" class="card-img-top"/></a>
                                </div>
                                    <div class="card-body">
                                                <h3 class="card-title text-center">{{ $row->themename }}</h3>
                                                 <a href ="{{ $editorurl }}" target="_new" class="btn btn-success">Use</a>
                                            </div>

                                </div>

                                
                            @endforeach</div>
                                                </div>
                        </div>
              




                    </div>
                </div>
            </div>
        </div>
@endsection
