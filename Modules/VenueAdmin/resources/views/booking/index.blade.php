@extends('venueadmin::layouts.admin-layout')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

<style>
    .fc-daygrid-day-events {
        display: flex;
        align-items: flex-start; /* Aligns items at the top */
        padding-top: 50px; /* Push down */
        height: 100px;
    }
    .wedding_image{
        width: 45px;
        height: 45px;
        margin-left: 2px;
    }
    .fc-daygrid-day-number{
        background: #58111A !important;
        color: white;
    }
</style>
@section('content')

<div id="calendar"></div>

 <!-- BEGIN MODAL -->
<!-- <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <span class="model-heading">Are you want to book this date?</span>
            </div>
        </div>
    </div>
</div> -->
<input type="hidden" name="booking_date" id="booking_date">
<input type="hidden" name="venue_count" id="venue_count" value="{{ $venueCount }}">
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-20 font-color" id="modalLabel">Confirm Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
            <span class="font-16"> Are you sure you want to book this date? </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary book_date_confirm" id="confirmBooking">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-20 font-color" id="modalLabel">Warning !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
            <span class="font-16">Please add atleast one venue for your bookings!</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // var venue_id = $("#venue_id").val();
        var calendarEl = document.getElementById("calendar");
        if (calendarEl) {
            var muhurthamDates;
            $.ajax({
                url: '/api/get-muhurtam-dates',
                success: function(response) {
                    muhurthamDates = response;
                },
                error: function(error) {
                    failureCallback(error);
                }, async:false
            });
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                selectable: true, // Enable date selection
                // events: "/api/"+venue_id+"/get-events/", 
                //     events: function(fetchInfo, successCallback, failureCallback) {
                //     $.ajax({
                //         url: '/api/'+venue_id+'/get-events',
                //         success: function(response) {
                //             let events = response.map(event => ({
                //               id:event.id,  
                //             title: event.title,
                //             start: event.start + 'T00:00:00',
                //             end: event.end + 'T00:00:00',
                //             color: event.color || getRandomColor(), 
                //         }));
                //         successCallback(events);
                //         },
                //         error: function(error) {
                //             failureCallback(error);
                //         }
                //     });
                // },
                dayCellDidMount: function (arg) {
                    console.log(muhurthamDates, 'muhurthamDates');
                    let date = new Date(arg.date);
                    let currentDate = date.toLocaleDateString('en-CA');
                    let muhurthamData = muhurthamDates.find(muhurtham => muhurtham.muhurtham_date === currentDate);

                    if (muhurthamData) {

                        let img = document.createElement("img");
                        img.src = "{{ asset('assets/images/wedding-image.png') }}";
                        // img.style.width = "45px";
                        // img.style.height = "45px";
                        // img.style.position = "absolute";
                        // img.style.top = "80px";
                        // img.style.left = "2px";
                        img.className = "wedding_image";

                        arg.el.style.position = "relative";
                        arg.el.querySelector(".fc-daygrid-day-events")?.appendChild(img);

                        if (muhurthamData?.muhurtham_type === "Subha Muhurtham") {
                            let mangalyamImg = document.createElement("img");
                            mangalyamImg.src = "{{ asset('assets/images/mangalyam.png') }}";
                            // mangalyamImg.style.width = "35px";
                            // mangalyamImg.style.height = "45px";
                            // mangalyamImg.style.position = "absolute";
                            // mangalyamImg.style.top = "0px";
                            // mangalyamImg.style.left = "0px";
                            mangalyamImg.className = "wedding_image";

                            arg.el.style.position = "relative";
                            arg.el.querySelector(".fc-daygrid-day-top")?.appendChild(mangalyamImg);
                        }
                    }
                },
                eventDidMount: function(info) {
                    // Optional: Add custom styling or tooltips
                    console.log("Event rendered:", info.event);
                },
            
                dateClick: function(info) {
                    document.getElementById("event-start-date").value = info.dateStr;
                    document.getElementById("event-end-date").value = info.dateStr;
                    $('#booking_date').val(info.datestr);

                    // Open Bootstrap modal
                    var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
                    myModal.show();
                },
                eventClick: function(info) {
                    console.log("Event Object:", info.event);
                    let event = info.event;
                    console.log(event.id);
                    // document.getElementById("bookingform").reset();
                    // document.getElementById("day-type-containers").innerHTML = "";
                    // $.ajax({
                    //     url: '/api/get-event-details/' + event.id,
                    //     method: 'GET',
                    //     success: function(response) {
                    //       console.log(response);
                    //         document.getElementById("event_name").value = response.event_name;
                    //         document.getElementById("event-start-date").value = response.start_date;
                    //         document.getElementById("event-end-date").value = response.end_date;
                    //         document.getElementById("booking_id").value = response.id;
                    //         document.getElementById("person_name").value = response.person_name;
                    //         document.getElementById("contact_address").value = response.contact_address;
                    //         document.getElementById("mobileno").value = response.mobileno;
                    //         document.getElementById("special_requirements").value = response.special_requirements;

                        
                    //         $('input[name="bookingstatus"][value="' + response.booking_status + '"]').prop("checked", true);

                    //         response.daytypes.forEach(day => {
                    //             let dayTypeContainer = `
                    //                 <div class="col-md-6 mt-2">
                    //                     <label class="form-label">Day (${day.date})</label>
                    //                     <div class="d-flex">
                    //                         <div class="n-chk">
                    //                             <div class="form-check form-check-primary form-check-inline">
                    //                                 <input class="form-check-input daytype" type="radio" name="daytype-${day.date}" value="full" ${day.daytype === 'full' ? 'checked' : ''} />
                    //                                 <label class="form-check-label">Full Day</label>
                    //                             </div>
                    //                         </div>
                    //                         <div class="n-chk">
                    //                             <div class="form-check form-check-warning form-check-inline">
                    //                                 <input class="form-check-input daytype" type="radio" name="daytype-${day.date}" value="morning" ${day.daytype === 'morning' ? 'checked' : ''} />
                    //                                 <label class="form-check-label">Morning</label>
                    //                             </div>
                    //                         </div>
                    //                         <div class="n-chk">
                    //                             <div class="form-check form-check-warning form-check-inline">
                    //                                 <input class="form-check-input daytype" type="radio" name="daytype-${day.date}" value="evening" ${day.daytype === 'evening' ? 'checked' : ''} />
                    //                                 <label class="form-check-label">Evening</label>
                    //                             </div>
                    //                         </div>
                    //                     </div>
                    //                 </div>
                    //             `;
                    //             $("#day-type-containers").append(dayTypeContainer);
                    //         });

                        
                    //         var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
                    //         myModal.show();
                    //     }
                    // });
                },
                dateClick: function(info) {
                
                    // document.getElementById("bookingform").reset();
                    // document.getElementById("booking_id").value = "0"; // Ensure no previous ID
                    // document.getElementById("event-start-date").value = info.dateStr;
                    // document.getElementById("event-end-date").value = info.dateStr;

                
                    // document.getElementById("day-type-containers").innerHTML = "";
                    const date = new Date(info.date);
                    const formattedDate = date.toLocaleDateString('en-CA');
                    $('#booking_date').val(formattedDate);

                    var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
                    myModal.show();
                },
            });
            calendar.render();
        } else {
            console.error("Error: #calendar element not found.");
        }
    });

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

     /*    var calendar; 

    document.addEventListener("DOMContentLoaded", function () {
    var venue_id = $("#venue_id").val();
    console.log(venue_id);
    
    var calendarEl = document.getElementById("calendar");

    if (calendarEl) {
      
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            selectable: true,
            events: "/api/"+venue_id+"/get-eventsbyid", 
            eventClick: function(info) {
                let event = info.event;
                console.log('Event '+event.id);
                document.getElementById("bookingform").reset();
                document.getElementById("booking_id").value = event.id;
                document.getElementById("event_name").value = event.title;
               *document.getElementById("person_name").value = event.contact_person;
                document.getElementById("contact_address").value = event.contact_address;
                document.getElementById("mobileno").value = event.mobileno;*
                document.getElementById("event-start-date").value = event.startStr;
                document.getElementById("event-end-date").value = event.endStr;
                
                var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
                $("#updateEvent").css('display','block');
                $("#deleteEvent").css('display','block');
                $("#saveEvent").css('display','none');

                myModal.show();
            },
            dateClick: function(info) {
                document.getElementById("bookingform").reset();
                document.getElementById("booking_id").value = "0"; 
                document.getElementById("event-start-date").value = info.dateStr;
                document.getElementById("event-end-date").value = info.dateStr;

                var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
                myModal.show();
            }
        });

        calendar.render();
    } else {
        console.error("Error: #calendar element not found.");
    }
});
*/

$('#saveEvent').on('click', function() {
    var bookingstatus = $("input[type='radio'][name='bookingstatus']:checked").val();

    var eventData = {
        _token: $('meta[name="_token"]').attr('content'),
        title: $('#event_name').val(),
        // venue_id: $('#venue_id').val(),
        event_id: $('#event_id').val(),
        person_name: $('#person_name').val(),
        bookinguserid: $('#bookinguserid').val(),
        contact_address: $('#contact_address').val(),
        mobileno: $('#mobileno').val(),
        bookingstatus: bookingstatus,
        special_requirements: $('#special_requirements').val(),
        startdate: $('#event-start-date').val(),
        enddate: $('#event-end-date').val(),
        daytypes: {}
    };

    $('input[type="radio"].daytype:checked').each(function() {
        let dateKey = $(this).attr('name');
        eventData.daytypes[dateKey] = $(this).val();
    });

    $.ajax({
        url: '/api/save-booking',
        method: 'POST',
        data: eventData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                const newEvent = {
                    id: response.data.id,
                    title: response.data.event_title,
                    start: response.data.start_date + 'T00:00:00',
                    end: response.data.end_date + 'T23:59:59',
                    color: '#007bff'
                };

               
                calendar.addEvent(newEvent);

                $('#eventModal').modal('hide');
                calendar.render(); 
            } else {
                console.error("Error:", response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
});

    

// document.addEventListener("DOMContentLoaded", function () {
//     const startDateInput = document.getElementById("event-start-date");
//     const endDateInput = document.getElementById("event-end-date");
//     const dayTypeContainers = document.getElementById("day-type-containers");

//     startDateInput.addEventListener("change", generateDayTypeInputs);
//     endDateInput.addEventListener("change", generateDayTypeInputs);

//     function generateDayTypeInputs() {
//         const startDate = startDateInput.value;
//         const endDate = endDateInput.value;

//         if (startDate && endDate) {
//             const start = new Date(startDate);
//             const end = new Date(endDate);
//             const diffInDays = (end - start) / (1000 * 60 * 60 * 24) + 1; // +1 to include both start and end dates

//             dayTypeContainers.innerHTML = ''; // Clear previous inputs

//             for (let i = 0; i < diffInDays; i++) {
//                 const currentDate = new Date(start);
//                 currentDate.setDate(currentDate.getDate() + i);
//                 const formattedDate = currentDate.toISOString().split('T')[0]; // YYYY-MM-DD

//                 const dayTypeContainer = document.createElement('div');
//                 dayTypeContainer.classList.add('col-md-6', 'mt-2');
//                 dayTypeContainer.innerHTML = `
//                     <label class="form-label">Day ${i + 1} (${formattedDate})</label>
//                     <div class="d-flex">
//                         <div class="n-chk">
//                             <div class="form-check form-check-primary form-check-inline">
//                                 <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="full" required />
//                                 <label class="form-check-label">Full Day</label>
//                             </div>
//                         </div>
//                         <div class="n-chk">
//                             <div class="form-check form-check-warning form-check-inline">
//                                 <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="morning" />
//                                 <label class="form-check-label">Morning</label>
//                             </div>
//                         </div>
//                         <div class="n-chk">
//                             <div class="form-check form-check-warning form-check-inline">
//                                 <input class="form-check-input daytype" type="radio" name="daytype-${formattedDate}" value="evening" />
//                                 <label class="form-check-label">Evening</label>
//                             </div>
//                         </div>
//                     </div>
//                 `;
//                 dayTypeContainers.appendChild(dayTypeContainer);
//             }
//         } else {
//             dayTypeContainers.innerHTML = ''; // Clear if dates are not selected
//         }
//     }
// });


    $('#updateEvent').on('click', function () {
        var bookingstatus = $("input[type='radio'][name='bookingstatus']:checked").val();
        var eventData = {
            _token: $('meta[name="_token"]').attr('content'),
            booking_id: $('#booking_id').val(), // Include the booking ID for updates
            title: $('#event_name').val(),
            // venue_id: $('#venue_id').val(),
            event_id: $('#event_id').val(),
            person_name: $('#person_name').val(),
            contact_address: $('#contact_address').val(),
            mobileno: $('#mobileno').val(),
            bookingstatus: bookingstatus,
            special_requirements: $('#special_requirements').val(),
            startdate: $('#event-start-date').val(),
            enddate: $('#event-end-date').val(),
            daytypes: {}
        };

        $('input[type="radio"][class="form-check-input daytype"]:checked').each(function () {
            let dateKey = $(this).attr('name');
            eventData.daytypes[dateKey] = $(this).val();
        });

        $.ajax({
            url: '/api/update-booking/' + $('#booking_id').val(), // Use a different route for updates
            method: 'PUT', // Use PUT method for updates
            data: eventData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    // Update the event in the calendar
                    let updatedEvent = calendar.getEventById(response.data.id);
                    if (updatedEvent) {
                        updatedEvent.setProp('title', response.data.event_title);
                        updatedEvent.setStartEnd(response.data.start_date, response.data.end_date); // Update start/end
                        updatedEvent.setProp('color', getRandomColor()); // Update other properties as needed
                        calendar.render();
                    }

                    $('#eventModal').modal('hide');
                    calendar.render();
                } else {
                    console.error("Error:", response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });

    // Delete Event
    $("#deleteEvent").on("click", function () {
        const bookingId = $("#booking_id").val();

        if (confirm("Are you sure you want to delete this event?")) {
            $.ajax({
                url: '/api/delete-booking/' + bookingId, // Your delete route
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        let eventToDelete = calendar.getEventById(bookingId);
                        if (eventToDelete) {
                            eventToDelete.remove(); // Remove from calendar
                        }
                        $('#eventModal').modal('hide');
                        calendar.render();
                    } else {
                        console.error("Delete Error:", response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Delete Error:", error);
                }
            });
        }
    });

    $('.book_date_confirm').on('click', function(){
        $('#eventModal').modal('hide');
        if($('#venue_count').val() > 0){
            let bookingDate = $('#booking_date').val(); // Get the date value
            let url = "{{ url('/venueadmin/venue/booking/add') }}/" + bookingDate;
            window.open(url, '_blank'); 
        }
        else{
            $('#warningModal').modal('show');
        }
    })
</script>

@endpush