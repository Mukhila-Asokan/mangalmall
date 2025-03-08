@extends('admin.layouts.app-admin')
@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Venue User Request</h4>



                <div class="text-end">
                    <a href="{{ route('venue.mobilechangerequest') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span> ChangeMobileNo Request 
                    </a>
                </div>

            @if($id == 2)    
            <div class="text-end">
                <a href="{{ route('venue.venueadminlist') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                    <span class="tf-icon mdi mdi-eye me-1"></span> Venue Admin 
                </a>
            </div>
            @else
                <div class="text-end">
                    <a href="{{ route('venue.venueportalrequest') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span> Venue Portal Request 
                    </a>
                </div>
            @endif
                    <div class="row">

                    <div class="table-responsive">
                             @php $i=1; @endphp
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>venue Admin Name</th>
                                        <th>City</th>
                                        <th>Mobile No</th>
                                        <th>Registered Date</th>
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
                                        <td>{{ $typename->created_at->format('d/m/y') }}</td>
                                        <td>@if($typename->status == 'Active')
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $typename->id }}" title="Active Status"><i class="fa fa-eye action_icon"></i></button>
                @else 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="{{ $typename->id }}" title="Inactive Status"><i class="fa fa-eye-slash action_icon"></i></button>
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