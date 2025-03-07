@extends('venueadmin::layouts.admin-layout')
@section('content')
 <div class="col-12">
    <div class="card">

        <div class="card-body p-4">
        <div class="row mt-4">
                <div class="text-end">   
                        <a href="{{ route('venuepricing.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-plus"></i>Add Pricing
                        </a>
                </div>
        </div>
        <h3 class="text-center mt-2 mb-2">Venue Pricing List</h3>
            <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>#</th>
                            <th>Venue Name</th>
                            <th>Pricing Type</th>
                            <th>Base Price</th>
                            <th>Peak Price</th>
                            <th>Deposit Amount</th>
                            <th>Addons</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = ($pricing->currentPage() - 1) * $pricing->perPage() + 1;
                        @endphp
                        @if(count($pricing) > 0)
                            @foreach($pricing as $pricing)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $pricing->venue->venuename }}</td>
                                    <td>{{ $pricing->pricing_type }}</td>
                                    <td>{{ $pricing->venue->bookingprice }}</td>
                                    <td>{{ $pricing->peak_rate }}</td>
                                    <td>{{ $pricing->deposit_amount }}</td>
                                    <td>
                                    @php
                                            $bookingaddons = Modules\VenueAdmin\Models\VenuePricingAddon::where('venuepricingid', $pricing->id)->with('addon')->get();
                                            @endphp

                                            @foreach($bookingaddons as $bookingad)
                                                <div>{{ $bookingad->addon->addonname }}: {{ $bookingad->addon->price }}</div>
                                            @endforeach

                                    </td>
                                    <td>
                                        @if($pricing->status == 'Active')
                                        <button type="button" class="btn-warning btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $pricing->id }}" title="Active Status">
                                                <i class="bi bi-check-circle-fill"></i> 
                                            </button>
                                        @else
                                        <button type="button" class="btn btn-danger statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="{{ $pricing->id }}" title="Inactive Status">
                                                <i class="bi bi-x-circle-fill"></i> 
                                        </button>
                                        @endif                                       

                                        <a href="{{ url('/venueadmin/venuepricing/'.$pricing->id.'/edit') }}" class="btn btn-info" title="Edit">
                                            <i class="bi bi-pencil-fill"></i> 
                                        </a>
                                        
                                        <button type="button" class="btn btn-danger deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="{{ $pricing->id }}" title="Delete">
                                            <i class="bi bi-trash2-fill"></i> 
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="">
                                    <div class="d-flex justify-content-center"> 
                            
                                    </div>
                                </td>
                            </tr>
                          
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No Records Found</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="8" class="text-center">
                               
                            </td>
                        </tr>
                    </tbody>
                </table>
              
                
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/venueadmin/venuepricing/') }}">  
@endsection