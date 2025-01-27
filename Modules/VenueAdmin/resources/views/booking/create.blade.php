@extends('venueadmin::layouts.admin-layout')
@section('content')
<style>
	.fc-direction-ltr .fc-daygrid-event.fc-event-end, .fc-direction-rtl .fc-daygrid-event.fc-event-start
	{
		line-height:40px;
		background-color: #f5dcf2;
		border-radius:0px;
		font-size:10px
	}
	

</style>
 <div class="col-12">
 
  <div class="card">
	<div class="card-body calender-sidebar app-calendar">
		 <div id="calendar"></div>

	</div>
</div>

  <!-- BEGIN MODAL -->
          <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="eventModalLabel">
                    Add / Edit Event
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
			<form name = "bookingform" id = "bookingform" action = "#" >
                <div class="modal-body">
                  <div class="row p-4">
                    <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Event Name</label>
                        <input id="event_name" type="text" name="event_name" class="form-control" value = "" />
                      </div>
                    </div>
                    <div class ="col-md-6 mt-6">
                    	  <div>
                        <label class="form-label">Event Type</label>                        	
                        	<select name="event_id" id = "event_id" class="form-select">
                        		<option value = "">Select Events</option>
                        		@foreach($occasion_types as $type)
                        			<option value = "{{ $type->id }}">{{ $type->eventtypename }}</option>
                        		@endforeach
                        	</select>
                      </div>
                    </div>
					<input type = "hidden" name ="venue_id" id ="venue_id" value = "{{ $venueid }}" />
					<input type = "hidden" name ="booking_id" id ="booking_id" value = "" />
                    <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Contact Person Name</label>
                        <input id="person_name" name = "person_name" type="text" class="form-control" />
                      </div>
                    </div>
                      <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Address</label>
                        <textarea id="contact_address" name ="contact_address" class="form-control" /></textarea>
                      </div>
                    </div>
                  <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Phone No</label>
                        <input id="mobileno" type="text" name = "mobileno" class="form-control" />
                      </div>
                  </div>
                  <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Booking Status</label>
                      </div>
                      <div class="d-flex">
                        <div class="n-chk">
                          <div class="form-check form-check-primary form-check-inline">
                            <input class="form-check-input bookingstatus" type="radio" name="bookingstatus" value="Confirmed" id="modalDanger" />
                            <label class="form-check-label" for="modalDanger">Confirmed</label>
                          </div>
                        </div>
                        <div class="n-chk">
                          <div class="form-check form-check-warning form-check-inline">
                            <input class="form-check-input bookingstatus" type="radio" name="bookingstatus" value="Hold" id="modalSuccess" />
                            <label class="form-check-label" for="modalSuccess">Hold</label>
                          </div>
                        </div>
                      </div>
                  </div>

                   <div class="col-md-12 mt-6">
                      <div>
                        <label class="form-label">Special Requirements</label>
                        <textarea id="special_requirements" class="form-control" name ="special_requirements"></textarea>
						</div>
                  </div>

                    <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Enter Start Date</label>
                        <input id="event-start-date" type="date" class="form-control" name="event-start-date" />
                      </div>
                    </div>

                    <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Enter End Date</label>
                        <input id="event-end-date" type="date" class="form-control" name = "event-end-date" />
                      </div>
                    </div>
                     <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Enter Start Time</label>
                        <input id="event-start-time" type="time" class="form-control" name = "event-start-time" />
                      </div>
                    </div>
                    <div class="col-md-6 mt-6">
                      <div>
                        <label class="form-label">Enter End Time</label>
                        <input id="event-end-time" type="time" class="form-control" name="event-end-time" />
                      </div>
                    </div>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                    Close
                  </button>                  
                  <button type="button" class="btn btn-primary btn-add-event" id="saveEvent">
                   Save
                  </button> 
				  <button type="button" class="btn btn-warning btn-update-event" id="updateEvent" style = "display:none">
                   Update
                  </button>


                </div>
				</form>
              </div>
            </div>
          </div>
          <!-- END MODAL -->

</div>

@endsection
@push('scripts')
	
  <script src="{{ asset('public/venueassets/libs/fullcalendar/index.global.min.js') }}"></script>
  <script src="{{ asset('public/venueassets/js/apps/calendar-init.js') }}"></script>
@endpush