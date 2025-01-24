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
				console.log(result);
            }
        });
        $('#eventModal').modal('show');
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