@extends('venueadmin::layouts.admin-layout')
<style>
	.venue-container {
		overflow: hidden;
		white-space: nowrap;
		width: 100%;
		padding: 10px 0;
		background: #f8f9fa;
		position: relative;
	}

	.venue-scroller {
		display: flex;
		gap: 15px;
		animation: scroll 20s linear infinite;
	}

	.venue-card {
		min-width: 250px;
		background: white;
		padding: 15px;
		border-radius: 8px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		text-align: center;
		transition: transform 0.3s;
	}

	.venue-card:hover {
		transform: scale(1.05);
	}

	/* Scrolling Animation */
	/* @keyframes scroll {
		0% { transform: translateX(100%); }
		100% { transform: translateX(-100%); }
	} */
</style>
@section('content')
	<div class="m-3 h3 d-flex" style="font-weight: bold;">
		Welcome <span class="font-color mleft-10">{{ $user->name }} </span> &nbsp;!
	</div>
	<div class="row m-2">
		<div class="col-lg-4 col-sm-4 col-md-4">
			<div class="card shadow-sm">
				<div class="card-header">
					<label class="h4 font-color font-bold">Open Booking Enquiries</label>
				</div>

				<div class="card-body">
					@if($bookings->isEmpty())
						<p class="text-muted text-center">No booking enquiries available.</p>
					@else
						<div class="list-group">
							@foreach($bookings as $booking)
								<div class="list-group-item d-flex justify-content-between align-items-center">
									<div>
										<h6 class="mb-1 text-primary">{{ $booking->name }}</h6>
										<small class="text-muted mb-1">{{ $booking->mobile_number }}</small>
										<p class="text-truncate mb-1" style="max-width: 250px;">
											{{ Str::limit($booking->message, 30, '...') }}
										</p>
									</div>
									<small class="text-secondary">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</small>
								</div>
							@endforeach
						</div>
					@endif
				</div>

				<div class="card-footer text-center bg-light">
					<a href="{{ route('get.all.enquiries') }}" class="btn btn-primary btn-sm">View All Enquiries</a>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6">
			<div class="card">
				<div class="card-header">
					<label class="h4 font-color font-bold"> Venue Booking Month wise</label>
				</div>
				<canvas id="dashboardChart" class="p-1"></canvas>
			</div>
		</div>
		<div class="col-lg-2 col-sm-2 col-md-2">
			<div class="card">
				<div class="card-header">
					<label class="h5 font-color font-bold">Today Bookings</label>
				</div>
				<div class="card-body text-center">
					<span id="venue_booking_count" class="h2"></span>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<label class="h5 font-color font-bold">Monthly Bookings</label>
				</div>
				<div class="card-body text-center">
					<span id="venue_this_month_booking_count" class="h2"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="card border-0">
			<div class="card-header">
				<label class="h4 font-color font-bold">Top Venues</label>
			</div>
			<div class="card-body">
				<div class="venue-container">
					<div class="venue-scroller">
						@foreach ($topBookedVenues as $venue)
							<div class="venue-card">
								<h5>{{ $venue->venuename }}</h5>
								<span class="mt-1 mb-1">{{ $venue->description }}</span>
								<p><strong>Total Bookings:</strong> {{ $venue->total_bookings }}</p>
								<a href="{{ route('venueadmin/view', ['id', $venue->id]) }}" class="btn btn-primary btn-sm">View</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script>
		$(document).ready(function(){
			$.ajax({
				url: "{{ route('get-dashboard-data') }}",
				type: "GET",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				},
				success: function(response){
					console.log(response);
					$('#venue_booking_count').text(response.todayCounts);
					$('#venue_this_month_booking_count').text(response.monthBookingCount)
					const Utils = {
						months: ({ count }) => {
							const monthNames = response.allFormattedMonths;
							return monthNames.slice(0, count);
						}
					};
					const labels = Utils.months({ count: 12 });
					const data = {
					labels: labels,
					datasets: [{
						label: 'Venue Booking Count',
						data: response.bookingCounts,
						backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(255, 205, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(153, 102, 255, 0.2)'
						],
						borderColor: [
						'rgb(255, 99, 132)',
						'rgb(255, 205, 86)',
						'rgb(75, 192, 192)',
						'rgb(54, 162, 235)',
						'rgb(153, 102, 255)'
						],
						borderWidth: 1
					}]
					};
					const config = {
						type: 'bar',
						data: data,
						options: {
							scales: {
							y: {
								beginAtZero: true
							}
							}
						}
					};
					const ctx = document.getElementById('dashboardChart').getContext('2d');
					new Chart(ctx, config);
				}
			});
		})
	</script>
@endpush