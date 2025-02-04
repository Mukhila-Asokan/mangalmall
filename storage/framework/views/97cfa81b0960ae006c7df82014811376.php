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

                <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0"><?php echo e($pagetitle ?? ' Home '); ?></h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo e($pageroot ?? ' Home '); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e($pagetitle ?? ' Home '); ?></li>
                    </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


                 
                  <?php echo $__env->yieldContent('content'); ?>
               </div>

            </div>



    	<?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	</div>	
    </div>

<?php echo $__env->make('admin.layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>






<?php echo $__env->make('admin.layouts.popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?> 
<?php echo $__env->make('admin.layouts.popupscripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/layouts/app-admin.blade.php ENDPATH**/ ?>