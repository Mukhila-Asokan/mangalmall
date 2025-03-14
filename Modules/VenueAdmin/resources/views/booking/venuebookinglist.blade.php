@extends('venueadmin::layouts.admin-layout')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body p-4">
            <h3 class="text-center mt-2 mb-4">Venue Booking List</h3>
            <ul class="nav nav-tabs" id="venueTab" role="tablist">
                @foreach($venues as $venue)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($loop->first) active @endif" id="tab{{ $venue->id }}" data-bs-toggle="tab" data-bs-target="#content{{ $venue->id }}" type="button" role="tab" aria-controls="content{{ $venue->id }}" aria-selected="true">
                            {{ $venue->venuename }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="accordion" id="venueAccordion">
                @foreach($venues as $venue)
                    <div class="tab-content" id="venueTabContent">
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="content{{ $venue->id }}" role="tabpanel" aria-labelledby="tab{{ $venue->id }}">
                            <div class="input-group mb-1 mt-3">
                                <input type="text" id="searchInput_{{$venue->id}}" class="form-control searchInput" placeholder="search">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                            </div>
                            <div class="table-responsive mb-4 border rounded-1">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>#</th>
                                            <th>Event Title</th>
                                            <th>Event Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>No of Days</th>
                                            <th>Booking Status</th>
                                            <th>Total Price</th>
                                            <th>Payment Status</th>
                                            <th>Special Requirements</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="venueBookingBody">
                                        @php
                                            $i = 1;                                              
                                        @endphp
                                        @foreach($venue->bookings as $booking)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $booking->event_title }}</td>
                                                <td>{{ $booking->event_name }}</td>
                                                <td>{{ $booking->start_date }}</td>
                                                <td>{{ $booking->end_date }}</td>
                                                <td>{{ $booking->noofdays }}</td>
                                                <td>{{ $booking->booking_status }}</td>
                                                <td>{{ $booking->total_price }}</td>
                                                <td>{{ $booking->payment_status }}</td>
                                                <td>{{ $booking->special_requirements }}</td>
                                                <td>
                                                    <a href = "{{ url('/venueadmin/venuebooking/'.$booking->id.'/invoicegenerator') }}" target="_new" class="btn btn-warning" title = "Invoice">
                                                        <i class="bi bi-file-spreadsheet"></i>

                                                    </a>
                                                    <a href="{{ url('/venueadmin/venuebooking/'.$booking->id.'/edit') }}" class="btn btn-info" title="Edit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger deleteid" data-bs-toggle="modal" data-bs-target="#delModal" data-id="{{ $booking->id }}" title="Delete">
                                                        <i class="bi bi-trash2-fill"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if(count($venue->bookings) == 0)
                                            <tr>
                                                <td colspan="11" class="text-center">No Records Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="redirecturl" id="redirecturl" value="{{ url('/venueadmin/venuebooking/') }}">

@endsection
@push('scripts')
	<script>
		$('.searchInput').on('input', function(){
			let searchValue = this.value.toLowerCase();
			let tableRows = document.querySelectorAll('tbody tr');

			tableRows.forEach(row => {
				let rowData = '';
				Array.from(row.cells).forEach(cell => {
					rowData += cell.textContent.toLowerCase() + ' ';
				});

				if (rowData.includes(searchValue)) {
					row.style.display = '';
				} else {
					row.style.display = 'none';
				}
			});
		});
		$(document).ready(function() {
			$('.nav-link').on('click', function() {
				$('.searchInput').val('').trigger('input');
			});
		});
	</script>
@endpush