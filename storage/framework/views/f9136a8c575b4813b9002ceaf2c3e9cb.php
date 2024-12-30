<?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    .navbar-custom
    {
        background:#752c37!important;
    }
    .navbar-custom .topbar .nav-link
    {
        color:white!important;
    }
</style>
   <!-- Begin page -->
    <div class="layout-wrapper">
    	
    	<?php echo $__env->make('admin.layouts.sidemenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
    	   
    	   <div class="page-content">
    	   		
    	   		<?php echo $__env->make('admin.layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                 
                  <?php echo $__env->yieldContent('content'); ?>
               </div>

            </div>



    	<?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	</div>	
    </div>

<?php echo $__env->make('admin.layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views\admin\layouts\app-admin.blade.php ENDPATH**/ ?>