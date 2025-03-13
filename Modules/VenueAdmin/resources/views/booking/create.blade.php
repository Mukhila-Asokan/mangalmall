@extends('venueadmin::layouts.admin-layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<style>
    .fc-daygrid-day-events {
        display: flex;
        align-items: flex-start; /* Aligns items at the top */
        padding-top: 50px; /* Push down */
    }

    .wedding_image {
        width: 45px;
        height: 45px;
        margin-left: 2px;
    }

    .fc-daygrid-day-number {
        background: #58111A !important;
        color: white;
    }

    .fc-event-time {
        display: none !important;
    }

    /* --- Booking Overlays --- */
    .booking-overlay {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 98%;
        height: 98%;
        pointer-events: none;
        z-index: 2;
    }

    /* Full-day booking - Completely gray */
    .full-day {
        background: rgba(150, 150, 150, 0.6); 
        pointer-events: none; /* Prevent clicks */
    }

    /* Morning Booking - Bottom Left */
    .morning-block {
        background: linear-gradient(to top right, rgba(150, 150, 150, 0.6) 50%, transparent 50%);
    }

    /* Evening Booking - Top Right */
    .evening-block {
        background: linear-gradient(to bottom left, rgba(150, 150, 150, 0.6) 50%, transparent 50%);
    }

    /* Remove dot event indicator */
    .fc-daygrid-event-dot {
        display: none !important;
    }

</style>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 <div class="col-12">
 
  <div class="card">
	<div class="card-body calender-sidebar app-calendar">
		 <div id="calendar"></div>

	</div>
</div>

<!-- BEGIN MODAL -->
    <div class="modal fade right" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">
                View Event Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="bookingform" id="bookingform" action="#">
                <div class="modal-body">
                    <div class="row p-1">
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Event Name</label>
                            <input id="event_name" type="text" name="event_name" class="form-control" value="" required />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Event Type</label>
                            <select name="event_id" id="event_id" class="form-select" required>
                                <option value="">Select Events</option>
                                @foreach($occasion_types as $type)
                                <option value="{{ $type->id }}">{{ $type->eventtypename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="venue_id" id="venue_id" value="{{ $venueid }}" />
                        <input type="hidden" name="booking_id" id="booking_id" value="" />
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Contact Person Name</label>
                            <input id="person_name" name="person_name" type="text" class="form-control" required />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Phone No</label>
                            <input id="mobileno" type="text" name="mobileno" class="form-control" required />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Address</label>
                            <textarea id="contact_address" name="contact_address" class="form-control" required></textarea>
                        </div>
                        <!-- <div class="col-md-6 mt-2">
                            <label class="form-label">Booking Status</label>
                            <div class="d-flex">
                                <div class="n-chk">
                                    <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input bookingstatus" type="radio" name="bookingstatus" value="Confirmed"
                                            id="modalDanger" required />
                                        <label class="form-check-label" for="modalDanger">Confirmed</label>
                                    </div>
                                </div>
                                <div class="n-chk">
                                    <div class="form-check form-check-warning form-check-inline">
                                        <input class="form-check-input bookingstatus" type="radio" name="bookingstatus" value="Hold"
                                            id="modalSuccess" />
                                        <label class="form-check-label" for="modalSuccess">Hold</label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-6 mt-2">
                            <label class="form-label">Special Requirements</label>
                            <textarea id="special_requirements" class="form-control" name="special_requirements"></textarea>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">Enter Start Date</label>
                            <input id="event-start-date" type="date" class="form-control" name="event-start-date" required />
                        </div>

                        <div class="col-md-6 mt-2">
                            <label class="form-label">Enter End Date</label>
                            <input id="event-end-date" type="date" class="form-control" name="event-end-date" required />
                        </div>

                        <!-- <div id="day-type-containers" class="row">
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer mt-5">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                        Close
                    </button>
                    <!-- <button type="button" class="btn btn-primary btn-add-event" id="saveEvent">
                        Save
                    </button>
                    <button type="button" class="btn btn-warning btn-update-event" id="updateEvent" style="display:none">
                        Update
                    </button> -->
                </div>
            </form>
            </div>
        </div>
    </div>

<div class="modal fade right" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="addVenueBooking" id="addVenueBooking" method="POST" action="{{route('add.venue.booking')}}">
            @csrf
            <div class="row p-1">
                <div class="col-md-6 mt-2">
                    <label class="form-label">Event Name</label>
                    <input id="add_event_name" type="text" name="event_name" class="form-control" value="" required />
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Event Type</label>
                    <select name="event_id" id="add_event_id" class="form-select" required>
                        <option value="">Select Events</option>
                        @foreach($occasion_types as $type)
                        <option value="{{ $type->id }}">{{ $type->eventtypename }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="venue_id" id="add_venue_id" value="{{ $venueid }}" />
                <input type="hidden" name="booking_id" id="add_booking_id" value="" />
                <div class="col-md-6 mt-2">
                    <label class="form-label">Contact Person Name</label>
                    <input id="add_person_name" name="person_name" type="text" class="form-control" required />
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Phone No</label>
                    <input id="add_mobileno" type="text" name="mobileno" class="form-control" required />
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Address</label>
                    <textarea id="add_contact_address" name="contact_address" class="form-control" required></textarea>
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Special Requirements</label>
                    <textarea id="add-special_requirements" class="form-control" name="special_requirements"></textarea>
                </div>

                <div class="col-md-6 mt-2">
                    <label class="form-label">Enter Start Date</label>
                    <input id="add-event-start-date" type="date" class="form-control" name="eventstartdate" required />
                </div>

                <div class="col-md-6 mt-2">
                    <label class="form-label">Enter End Date</label>
                    <input id="add-event-end-date" type="date" class="form-control" name="eventenddate" required />
                </div>

                <div id="add-day-type-containers" class="row">
                </div>
            </div>
            <div class="modal-footer mt-5">
                <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary btn-add-event">
                    Save
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END MODAL -->

</div>

@endsection
@push('scripts')
	
  <script src="{{ asset('venueassets/libs/fullcalendar/index.global.min.js') }}"></script>

  <script>
    document.getElementById('add-event-start-date').addEventListener('change', generateDayTypeInputs);
    document.getElementById('add-event-end-date').addEventListener('change', generateDayTypeInputs);

    function generateDayTypeInputs() {
        const startDate = document.getElementById('add-event-start-date').value;
        const endDate = document.getElementById('add-event-end-date').value;
        const dayTypeContainers = document.getElementById('add-day-type-containers');

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffInDays = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;

            dayTypeContainers.innerHTML = ''; // Clear previous

            for (let i = 0; i < diffInDays; i++) {
                const currentDate = new Date(start);
                currentDate.setDate(start.getDate() + i);
                const formattedDate = currentDate.toISOString().split('T')[0]; // YYYY-MM-DD

                dayTypeContainers.innerHTML += `
                    <div class="col-md-12 mb-2">
                        <label class="form-label">Day ${i + 1} (${formattedDate})</label>
                        <div class="d-flex">
                            <div class="n-chk">
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="full" required />
                                    <label class="form-check-label mt-1">Full</label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-warning form-check-inline">
                                    <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="morning" />
                                    <label class="form-check-label mt-1">Morning</label>
                                </div>
                            </div>
                            <div class="n-chk">
                                <div class="form-check form-check-warning form-check-inline">
                                    <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="evening" />
                                    <label class="form-check-label mt-1">Evening</label>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        } else {
            dayTypeContainers.innerHTML = ''; // Clear if no dates
        }
    }
</script>
<script src="{{ asset('venueassets/js/apps/calendar-booking.js') }}"></script>
@endpush

