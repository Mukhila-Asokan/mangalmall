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
                <h4 class="header-title mb-4">List of Venue User Request</h4>
                    <div class="row">

                    <div class="table-responsive">
                             @php $i=1; @endphp
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>City</th>
                                        <th>Mobile No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($venueuser) > 0)
                                    @foreach($venueuser as $typename)
                                    <tr>
                                        <th scope="row">{{  $i++ }}</th>
                                        <td>{{ $typename->name }}</td>           
                                        <td>{{ $typename->city }}</td>           
                                        <td>{{ $typename->mobileno }}</td>
                                        <td>@if($typename->status == 'Active')
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $typename->id }}" title="Status"><i class="fa fa-eye action_icon"></i></button>
                @else 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="{{ $typename->id }}" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
                @endif
           
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="{{ $typename->id }}" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                    </tr>                                             
                                    @endforeach
                                       {{ $venueuser->links('pagination::bootstrap-4') }}
           @else
                No Records Found
        @endif
                                </tbody>
                            </table>
                        </div> 
                      
                       
                    </div>
                        
                </div>
            </div>
        </div>
    </div>

@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/venueportalrequest/') }}">  