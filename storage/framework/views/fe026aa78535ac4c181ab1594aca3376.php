<?php echo $__env->make('venueadmin::layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php 

$url1 = asset("venueasset/images/bg-auth.jpg");

?>
<body style="background-image: url('<?php echo e($url1); ?>'); background-repeat: no-repeat;background-size: cover;">

 <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
      <div class="container">
          <div class="row justify-content-center">

              <?php echo $__env->make('venueadmin::layouts.flash-messages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
              <?php echo $__env->yieldContent('content'); ?>
            </div>
              <!-- end row -->
        </div>
          <!-- end container -->
 </div>
      <!-- end page -->

<?php echo $__env->make('venueadmin::layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->make('admin.layouts.popupscripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/layouts/auth-layout.blade.php ENDPATH**/ ?>