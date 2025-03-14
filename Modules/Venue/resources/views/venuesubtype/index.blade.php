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
                         <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header border-bottom">Venue Type</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new venue type</h5><br>
                                        <a href="{{ route('venuetype/create') }}" class="btn btn-primary waves-effect waves-light">Add</a>
                                        <a href="{{ route('venuetype/show') }}" class="btn btn-primary waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                             <div class="col-md-4">
                                <div class="card">
                                    <h5 class="card-header border-bottom">Venue Sub Type</h5>
                                    <div class="card-body">
                                        
                                        <h5 class="card-title">Create a new venue type</h5><br>
                                        <a href="{{ route('venuesubtype/create') }}" class="btn btn-primary waves-effect waves-light">Add</a>
                                        <a href="{{ route('venuesubtype/show') }}" class="btn btn-primary waves-effect waves-light">View</a>
                                    </div>
                                </div>
                                <!-- end card-box-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
