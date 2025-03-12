   <!-- App js -->
    <script src="<?php echo e(asset('adminassets/js/vendor.min.js')); ?>"></script>
    <script src="<?php echo e(asset('adminassets/js/app.js')); ?>"></script>

    <!-- Jquery Sparkline Chart  -->
    <script src="<?php echo e(asset('adminassets/libs/jquery-sparkline/jquery.sparkline.min.js')); ?>"></script>

    <!-- Jquery-knob Chart Js-->
    <script src="<?php echo e(asset('adminassets/libs/jquery-knob/jquery.knob.min.js')); ?>"></script>


    <!-- Morris Chart Js-->
    <script src="<?php echo e(asset('adminassets/libs/morris.js/morris.min.js')); ?>"></script>

    <script src="<?php echo e(asset('adminassets/libs/raphael/raphael.min.js')); ?>"></script>

    <!-- Dashboard init-->
    <script src="<?php echo e(asset('adminassets/js/pages/dashboard.js')); ?>"></script>


    <!-- Plugins js -->
        <script src="<?php echo e(asset('adminassets/libs/dropzone/min/dropzone.min.js')); ?>"></script>

        <!-- Demo js-->
        <script src="<?php echo e(asset('adminassets/js/pages/form-fileuploads.js')); ?>"></script>

        <script>

            $(document).ready(function() {
                fetchNotifications();
                 setInterval(fetchNotifications, 10000); // Only trigger on interval
    });



    function fetchNotifications() {
        $.ajax({
            url: "<?php echo e(route('admin.notifications')); ?>",
            method: "GET",
            success: function(data) {
                // Update Notification Count
                console.log(data.count);
                $("#notificationcount").text(data.count);

                // Update Notification List
                console.log(data.html);
                $(".dropdown-menu .px-1").html(data.html);
            },
            error: function(xhr) {
                console.error('Error fetching notifications:', xhr.responseText);
            }
        });
    }

    // Auto-refresh every 10 seconds
    setInterval(fetchNotifications, 10000);

    // CSRF token setup (important for Laravel AJAX requests)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/layouts/scripts.blade.php ENDPATH**/ ?>