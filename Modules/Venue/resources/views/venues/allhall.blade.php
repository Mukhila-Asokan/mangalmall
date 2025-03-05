@extends('admin.layouts.app-admin')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
             
                <h4 class="header-title mb-4">Venue Hall - {{ $venue->venuename }}</h4>

                <div class="text-end">
                    <a href="{{ route('venue.hallcreate',$parentid) }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-plus me-1"></span> Add
                    </a>
                </div>

                <div class="table-responsive">
                    @php $i=1; @endphp
                    @if(count($venuehalls) > 0)
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Hall Name</th>                              
                                <th>Contact Person</th>
                                <th>Location</th>
                                <th>Capacity</th>
                                <th>Budget</th>                       
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                            @foreach($venuehalls as $hall)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $hall->venuename }}</td>                                
                                <td>{{ $hall->contactperson }}</td>
                                <td>{{ $hall->area->areaname }}, {{ $hall->area->city->cityname }}</td>
                                <td>{{ $hall->capacity }}</td>
                                <td>{{ $hall->bookingprice }}</td>
                                
                                <td>                             

                                    @if($hall->status == 'Active')
                                    <button type="button" class="btn btn-primary waves-effect statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $hall->id }}" title="Active Status">
                                        <i class="fa fa-eye action_icon"></i>
                                    </button>
                                    @else
                                    <button type="button" class="btn-info btn waves-effect statusid" data-bs-toggle="modal" data-bs-target=".statusModal" data-id="{{ $hall->id }}" title="Inactive Status">
                                        <i class="fa fa-eye-slash action_icon"></i>
                                    </button>
                                    @endif
                                    <a href="{{ url('/admin/venue/hall/'.$hall->id.'/edit') }}" class="btn-warning btn waves-effect" title="Edit">
                                        <i class="fa fa-pencil action_icon"></i>
                                    </a>
                                    <button type="button" class="btn-danger waves-effect btn deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $hall->id }}" title="Delete">
                                        <i class="fa fa-trash action_icon"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                    {{ $venuehalls->links('pagination::bootstrap-4') }}
                    @else
                    No Records Found
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/admin/venue/hall/') }}">