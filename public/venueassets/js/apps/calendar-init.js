document.addEventListener('DOMContentLoaded', function() {


    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        events: fetchEvents, // Fetch events from backend
        dateClick: handleDateClick,
        eventClick: handleEventClick
    });
    calendar.render();

    // Create Event
    function handleDateClick(info) {
		/* $('#bookingform').find('input, select, textarea').val(''); 
		
		$('#bookingform')[0].reset();  // Resets all form fields
		$('#bookingform select').prop('selectedIndex', 0);  // Resets dropdowns
		$('#bookingform input:radio').prop('checked', false);  //*/
		
		$('#bookingform')[0].reset();
		
        $('#eventModal').modal('show');
        $('#eventStart').val(info.dateStr + 'T00:00');
    }

    // Save Event
    $('#saveEvent').on('click', function() {
		
		var bookingstatus = $("input[type='radio'][name='bookingstatus']:checked").val();

		
        var eventData = {
			_token:$('meta[name="_token"]').attr('content'),
            title: $('#event_name').val(),
            venue_id: $('#venue_id').val(),
            event_id: $('#event_id').val(),
            person_name: $('#person_name').val(),
            contact_address: $('#contact_address').val(),
            mobileno: $('#mobileno').val(),
            bookingstatus: bookingstatus,
            special_requirements: $('#special_requirements').val(),
            startdate: $('#event-start-date').val(),
            enddate: $('#event-end-date').val(),
            starttime: $('#event-start-time').val(),
            endtime: $('#event-end-time').val()          
            
        };

        $.ajax({
            url: '/venueadmin/venuebooking/addnewevents',
            method: 'POST',
            data: eventData,
			headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
            success: function(response) {
                calendar.addEvent(response);
                $('#eventModal').modal('hide');
				calendar.render(); 
            }
        });
    });

	// Update Event
    $('#updateEvent').on('click', function() {
		
		var bookingstatus = $("input[type='radio'][name='bookingstatus']:checked").val();
		
        var eventData = {
			_token:$('meta[name="_token"]').attr('content'),
            title: $('#event_name').val(),
            venue_id: $('#venue_id').val(),
            booking_id: $('#booking_id').val(),
            event_id: $('#event_id').val(),
            person_name: $('#person_name').val(),
            contact_address: $('#contact_address').val(),
            mobileno: $('#mobileno').val(),
            bookingstatus: bookingstatus,
            special_requirements: $('#special_requirements').val(),
            startdate: $('#event-start-date').val(),
            enddate: $('#event-end-date').val(),
            starttime: $('#event-start-time').val(),
            endtime: $('#event-end-time').val()          
            
        };

        $.ajax({
            url: '/venueadmin/venuebooking/updatenewevents',
            method: 'POST',
            data: eventData,
			headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
            success: function(response) {
                calendar.addEvent(response);
                $('#eventModal').modal('hide');
				calendar.render(); 
				$('#updateEvent').css('display','none');
				$('#saveEvent').css('display','block');
            }
        });
    });

    // Update Event
    function handleEventClick(clickInfo) {
		console.log(clickInfo.event.id);
        var event = clickInfo.event;
        $('#booking_id').val(clickInfo.event.id);
        $('#event_name').val(event.title);
       
		
        /* $('#event-start-date').val(formatDate(event.start));
        $('#event-end-date').val(formatDate(event.end));
        $('#eventDescription').val(event.extendedProps.description);   */
		
		
		var booking_id = $('#booking_id').val();
        $.ajax({
            url: '/venueadmin/venuebooking/'+booking_id+'/edit',
            method: 'GET',
            data: {               
                booking_id: booking_id
            },
            success: function(events) {			
			
				var result = Object.values(events);				
				 $('#person_name').val(result[1]['person_name']);
				 $('#contact_address').val(result[1]['contact_address']);
				 $('#mobileno').val(result[1]['mobileno']);
				 $('#special_requirements').val(result[0]['special_requirements']);
				 
				 var start_datetime = result[0]['start_datetime'];
				 var end_datetime = result[0]['end_datetime'];
				 
				 const [startdate, starttime] = start_datetime.split(' ');
				 const [enddate, endtime] = end_datetime.split(' ');
				 
				 $('#event-start-date').val(startdate);
				 $('#event-end-date').val(enddate);
				 
				 $('#event-start-time').val(starttime);
				 $('#event-end-time').val(endtime);
				 
				 $("#event_id option[value='"+ result[0]['event_id'] +"']").prop('selected', true);
				 $("input[type='radio'][value='"+ result[0]['booking_status'] +"']").prop('checked', true);
				 
				 
				console.log(result);
				$('#saveEvent').css('display','none');
				$('#updateEvent').css('display','block');
				calendar.render(); 
				 $('#eventModal').modal('show');
            }
        });
       
    }

    // Delete Event
    function deleteEvent(eventId) {
        $.ajax({
            url: `/venueadmin/venuebooking/delete/events/${eventId}`,
            method: 'DELETE',
            success: function() {
                calendar.getEventById(eventId).remove();
            }
        });
    }

    // Fetch Events
    function fetchEvents(fetchInfo, successCallback, failureCallback) {
		
		var venue_id = $('#venue_id').val();
        $.ajax({
            url: '/venueadmin/venuebooking/events',
            method: 'GET',
            data: {
                start: fetchInfo.startStr,
                end: fetchInfo.endStr,
                venueid: venue_id
            },
            success: function(events) {			
			
				var result = Object.values(events);
				/* console.log(result); */
				successCallback(result);
            }
        });
    }

    // Utility: Format Date
    function formatDate(date) {
        return date ? date.toISOString().slice(0, 16) : '';
    }
});