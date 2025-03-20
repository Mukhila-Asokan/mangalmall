@extends('admin.layouts.app-admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">List of Venue User Mobile No Change Request</h4>
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
                        @if($requests->isEmpty())
                            <p>No mobile change requests found.</p>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Old Mobile No.</th>
                                        <th>New Mobile No.</th>
                                        <th>Requested Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>{{ $request->venueAdmin->name }}</td>
                                            <td>{{ $request->venueAdmin->mobileno }}</td>
                                            <td>{{ $request->new_mobile_number }}</td>
                                            <td>{{ $request->created_at }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('mobilechange.approve', $request->venue_admin_id) }}">
                                                    @csrf
                                                    <input type="hidden" name="new_mobile" value="{{ $request->new_mobile_number }}">
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/venueportalrequest/') }}">  