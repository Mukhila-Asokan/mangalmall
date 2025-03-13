document.addEventListener("DOMContentLoaded", function () {
    var venue_id = $("#venue_id").val();
    var calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            selectable: true,
            events: function(fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: '/api/' + venue_id + '/get-events',
                    success: function(response) {
                        let storedEvents = response.map(event => ({
                            id: event.id,
                            title: event.title,
                            start: event.start + 'T00:00:00',
                            end: event.end + 'T00:00:00',
                            color: event.color || getRandomColor(),
                        }));
                        successCallback(storedEvents);
                    },
                    error: function(error) {
                        failureCallback(error);
                    }
                });
            },
            eventDidMount: function(info) {
                let eventEl = info.el;
                eventEl.classList.remove("fc-daygrid-dot-event"); 
                eventEl.classList.add("fc-daygrid-block-event", "fc-h-event");

                eventEl.style.backgroundColor = info.event.backgroundColor || "#58111A";
                eventEl.style.borderColor = info.event.borderColor || "#58111A";
                eventEl.style.color = "white";

                let titleEl = eventEl.querySelector(".fc-event-title");
                if (titleEl) {
                    titleEl.style.fontSize = "14px"; 
                    titleEl.style.padding = "2px";
                }

                // **Fetch `daytypes` dynamically** for this event
                $.ajax({
                    url: '/api/get-event-daytypes/' + info.event.id,  // New API endpoint
                    method: 'GET',
                    success: function(response) {
                        console.log(response, 'response');
                        let daytypes = response.daytypes; // Assuming response contains date-wise daytypes
                        console.log(daytypes, 'daytypes');
                        Object.keys(daytypes).forEach(date => {
                            let cell = document.querySelector(`.fc-daygrid-day[data-date="${date}"]`);
                            if (cell) {
                                let dayType = daytypes[date];
                                cell.style.position = "relative";

                                if (!cell.querySelector(".booking-overlay")) {
                                    let overlayDiv = document.createElement("div");
                                    overlayDiv.classList.add("booking-overlay");
                                    cell.appendChild(overlayDiv);
                                }

                                let overlay = cell.querySelector(".booking-overlay");

                                if (dayType === "full") {
                                    overlay.classList.add("full-day");
                                    // cell.style.pointerEvents = "none";
                                } else {
                                    cell.style.pointerEvents = "auto";

                                    if (dayType === "morning") {
                                        overlay.classList.add("morning-block");
                                        cell.setAttribute("data-blocked-morning", "true");
                                    } 
                                    if (dayType === "evening") {
                                        overlay.classList.add("evening-block");
                                        cell.setAttribute("data-blocked-evening", "true");
                                    }

                                    if (cell.getAttribute("data-blocked-morning") && cell.getAttribute("data-blocked-evening")) {
                                        // cell.style.pointerEvents = "none";
                                    }
                                }
                            }
                        });
                    },
                    error: function(error) {
                        console.error("Error fetching daytypes:", error);
                    }, async: false
                });
            },
            dateClick: function(info) {
                let clickedCell = document.querySelector(`.fc-daygrid-day[data-date="${info.dateStr}"]`);
                if (clickedCell) {
                    let overlay = clickedCell.querySelector(".booking-overlay");
                    if (overlay && overlay.classList.contains("full-day")) {
                        console.log("This day is fully booked. Cannot open modal.");
                        return;
                    }

                    let isMorningBlocked = clickedCell.getAttribute("data-blocked-morning") === "true";
                    let isEveningBlocked = clickedCell.getAttribute("data-blocked-evening") === "true";

                    let rect = clickedCell.getBoundingClientRect();
                    let clickX = info.jsEvent.clientX - rect.left;
                    let clickY = info.jsEvent.clientY - rect.top;

                    let isTopRight = clickX > rect.width / 2 && clickY < rect.height / 2;
                    let isBottomLeft = clickX < rect.width / 2 && clickY > rect.height / 2;

                    if ((isMorningBlocked && isBottomLeft) || (isEveningBlocked && isTopRight)) {
                        console.log("This part of the day is booked. Cannot open modal.");
                        return;
                    }
                }

                document.getElementById("bookingform").reset();
                document.getElementById("booking_id").value = "0";
                document.getElementById("add-event-start-date").value = info.dateStr;
                // document.getElementById("add-event-end-date").value = info.dateStr;
                $('#booking_date').val(info.dateStr);

                var myModal = new bootstrap.Modal(document.getElementById("addEventModal"));
                myModal.show();
            },
            eventClick: function(info) {
                console.log("Event Object:", info.event);
                let event = info.event;
                console.log(event.id);
                document.getElementById("bookingform").reset();

                $.ajax({
                    url: '/api/get-event-details/' + event.id,
                    method: 'GET',
                    success: function(response) {
                        response = response[0];
                        console.log(response, 'response');

                        document.getElementById("event_name").value = response.event_name;
                        document.getElementById("event-start-date").value = response.start_date;
                        document.getElementById("event-end-date").value = response.end_date;
                        document.getElementById("booking_id").value = response.id;
                        document.getElementById("person_name").value = response.person_name;
                        document.getElementById("contact_address").value = response.contact_address;
                        document.getElementById("mobileno").value = response.mobileno;
                        document.getElementById("special_requirements").value = response.special_requirements;
                        $('input[name="bookingstatus"][value="' + response.booking_status + '"]').prop("checked", true);

                        $("#bookingform input, #bookingform textarea, #bookingform select").prop("disabled", true);
                    
                        var myModal = new bootstrap.Modal(document.getElementById("eventModal"));
                        myModal.show();
                    }
                });
            },
        });

        calendar.render();
    } else {
        console.error("Error: #calendar element not found.");
    }
});
