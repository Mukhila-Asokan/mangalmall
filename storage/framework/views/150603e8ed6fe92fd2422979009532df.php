<?php $__env->startSection('content'); ?>
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
                    <?php $__currentLoopData = $occasion_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->eventtypename); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <input type="hidden" name="venue_id" id="venue_id" value="<?php echo e($venueid); ?>" />
            <input type="hidden" name="booking_id" id="booking_id" value="" />
            <div class="col-md-6 mt-2">
                <label class="form-label">Contact Person Name</label>
                <input id="person_name" name="person_name" type="text" class="form-control" required />
            </div>
            <div class="col-md-6 mt-2">
                <label class="form-label">Address</label>
                <textarea id="contact_address" name="contact_address" class="form-control" required></textarea>
            </div>
            <div class="col-md-6 mt-2">
                <label class="form-label">Phone No</label>
                <input id="mobileno" type="text" name="mobileno" class="form-control" required />
            </div>
            <div class="col-md-6 mt-2">
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
            </div>

            <div class="col-md-12 mt-2">
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

            <div id="day-type-containers" class="row">
              
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
        <button type="button" class="btn btn-warning btn-update-event" id="updateEvent" style="display:none">
            Update
        </button>
    </div>
</form>
              </div>
            </div>
          </div>
          <!-- END MODAL -->

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
	
  <script src="<?php echo e(asset('venueassets/libs/fullcalendar/index.global.min.js')); ?>"></script>

  <script>
    const startDateInput = document.getElementById('event-start-date');
    const endDateInput = document.getElementById('event-end-date');
    const dayTypeContainers = document.getElementById('day-type-containers');

    startDateInput.addEventListener('change', generateDayTypeInputs);
    endDateInput.addEventListener('change', generateDayTypeInputs);

    function generateDayTypeInputs() {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (startDate && endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diffInDays = (end - start) / (1000 * 60 * 60 * 24) + 1; // +1 to include both start and end dates

            dayTypeContainers.innerHTML = ''; // Clear previous inputs

            for (let i = 1; i <= diffInDays; i++) {
                const currentDate = new Date(start.getTime() + (i - 1) * (1000 * 60 * 60 * 24));
                const formattedDate = currentDate.toLocaleDateString('en-CA'); //YYYY-MM-DD

                const dayTypeContainer = document.createElement('div');
                dayTypeContainer.classList.add('col-md-6', 'mt-2');
                dayTypeContainer.innerHTML = `
                    <label class="form-label">Day ${i} (${formattedDate})</label>
                    <div class="d-flex">
                        <div class="n-chk">
                            <div class="form-check form-check-primary form-check-inline">
                                <input class="form-check-input daytype" type="radio" name="daytype-${i}" value="full" id="daytype-full-${i}" required />
                                <label class="form-check-label" for="daytype-full-${i}">Full</label>
                            </div>
                        </div>
                        <div class="n-chk">
                            <div class="form-check form-check-warning form-check-inline">
                                <input class="form-check-input daytype" type="radio" name="daytype-${i}" value="morning" id="daytype-morning-${i}" />
                                <label class="form-check-label" for="daytype-morning-${i}">Morning</label>
                            </div>
                        </div>
                        <div class="n-chk">
                            <div class="form-check form-check-warning form-check-inline">
                                <input class="form-check-input daytype" type="radio" name="daytype-${i}" value="evening" id="daytype-evening-${i}" />
                                <label class="form-check-label" for="daytype-evening-${i}">Evening</label>
                            </div>
                        </div>
                    </div>
                `;
                dayTypeContainers.appendChild(dayTypeContainer);
            }
        } else {
            dayTypeContainers.innerHTML = ''; // Clear if dates are not selected
        }
    }
</script>





  <script src="<?php echo e(asset('venueassets/js/apps/calendar-init.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('venueadmin::layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/booking/create.blade.php ENDPATH**/ ?>