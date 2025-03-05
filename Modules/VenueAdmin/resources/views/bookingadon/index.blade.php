@extends('venueadmin::layouts.admin-layout')
@section('content')
 <div class="col-12">
    <div class="card">
        <div class="card-body p-4">
        <div class="row mt-4">
                <div class="text-end">   
                        <a href="{{ route('bookingadons.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-plus"></i>Add Addon
                        </a>
                </div>
        </div>
            <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>#</th>
                            <th>Addon Name</th>
                            <th>Price</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @if(count($addons) > 0)
                            @foreach($addons as $addon)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $addon->addonname }}</td>
                                    <td>{{ $addon->price }}</td>
                                    <td>
                                        @if($addon->status == 'Active')
                                        <button type="button" class="btn-warning btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $addon->id }}" title="Active Status">
                                                <i class="bi bi-check-circle-fill"></i> 
                                            </button>
                                        @else
                                        <button type="button" class="btn btn-danger statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $addon->id }}" title="Inactive Status">
                                                <i class="bi bi-x-circle-fill"></i> 
                                        </button>
                                        @endif                                       

                                        <a href="{{ url('/venueadmin/venuepricingaddon/'.$addon->id.'/edit') }}" class="btn btn-info" title="Edit">
                                            <i class="bi bi-pencil-fill"></i> 
                                        </a>
                                        
                                        <a href="{{ url('/venueadmin/venuepricingaddon/'.$addon->id.'/edit') }}" class="btn btn-danger" title="Edit">
                                            <i class="bi bi-trash2-fill"></i> 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No Records Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/venueadmin/bookingadons/') }}">  
@endsection
