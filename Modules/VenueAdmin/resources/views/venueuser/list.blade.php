@extends('venueadmin::layouts.admin-layout')
@section('content')
 <div class="col-12">
 
  <div class="card">
	<div class="card-body p-4">
		<div class="col-12 text-end">
			<a href ="{{ route('venueadmin/create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
				<span class="tf-icon mdi mdi-plus me-1"></span><i class="bi bi-plus"></i> Add Venue
			</a>
		</div>
	  <div class="table-responsive mb-4 border rounded-1">
        <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
				  <tr>
						<th>#</th>
						<th>Venue Name</th>
						<th>Website Link</th>						
						<th>Venue Pricing</th>
						<th>Venue Booking</th>
						<!-- <th>Theme Builder</th> -->
						<th width="100px">Action</th>
				  </tr>
				  </thead>
				  <tbody>
				   @php $i=1; @endphp
				     @if(count($venues) > 0)
					@foreach($venues as $ven)
						 <tr>
                            <td>{{  $i++ }}</td>
							<td> {{ $ven->venuename }} </td>
							<td> {{ $ven->websitename }} </td>
							<td>
								<a href="javascript:void(0);" class="btn-primary btn" title="Pricing" data-bs-toggle="modal" data-bs-target="#pricingModal{{ $ven->id }}">
									<i class="ti ti-book action_icon"></i> Pricing
								</a>
								<!-- Modal -->

								@php
								$pricingDetails = DB::table('venuePricing')->where('venue_id', $ven->id)
								->where('delete_status','0')->where('status','Active')->get();
								@endphp
								<div class="modal fade" id="pricingModal{{ $ven->id }}" tabindex="-1" aria-labelledby="pricingModalLabel{{ $ven->id }}" aria-hidden="true">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="pricingModalLabel{{ $ven->id }}">Venue Pricing Details</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
											
											<div class="pricing-details">
    											<p><strong>Pricing details for {{ $ven->venuename }} - Price: ${{ $ven->bookingprice }}</strong></p>

												@if($pricingDetails->isNotEmpty())
													@foreach($pricingDetails as $pricing)
														<div class="pricing-type-section">
															<h5>Pricing Type: {{ $pricing->pricing_type }}</h5>

															<table class="table pricing-table">
																<thead>
																	<tr>
																		<th>Peak Rate</th>
																		<th>Deposit Amount</th>
																		<th>Base Price</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>${{ $pricing->peak_rate }}</td>
																		<td>${{ $pricing->deposit_amount }}</td>
																		<td>${{ $pricing->base_price }}</td>
																	</tr>
																</tbody>
															</table>

															@php
																$bookingAddons = Modules\VenueAdmin\Models\VenuePricingAddon::where('venuepricingid', $pricing->id)->with('addon')->get();
															@endphp

															@if($bookingAddons->isNotEmpty())
																<p><strong>Extras:</strong></p>
																<ul class="extras-list">
																	@foreach($bookingAddons as $bookingAddon)
																		<li>{{ $bookingAddon->addon->addonname }}: ${{ $bookingAddon->addon->price }}</li>
																	@endforeach
																</ul>
															@endif
														</div>

														@if(!$loop->last)
															<hr>
														@endif
													@endforeach
												@else
													<p>No pricing details available.</p>
												@endif
											</div>

											
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td>
								<a href="{{ url('/venueadmin/venuebooking/'.$ven->id.'/add') }}" class="btn-success btn" title="Booking">
									<i class="ti ti-bookmark action_icon"></i> Booking
								</a>
							</td>
							<!-- <td> <a href="{{ url('/venueadmin/themebuilder/'.$ven->id.'/edit') }}" class="btn-info btn" title="Theme"><i class="ti ti-wand action_icon"></i>
                Theme </a></td> -->
							<td>
                            <a href="{{ url('/venueadmin/viewvenue/'.$ven->id.'') }}" class="font-20 text-primary mleft-10"><i class="bi bi-eye"></i></a>
							<a href="{{ url('/venueadmin/editvenue/'.$ven->id.'') }}" class="font-20 text-warning mleft-10" title="Edit"><i class="bi bi-pencil-square"></i></a>
				
				</td>
						</tr>
					@endforeach
					@else                                     
							No Records Found
					@endif
				  </tbody>

	   </table>
	</div>
</div>
</div>
</div>
@endsection