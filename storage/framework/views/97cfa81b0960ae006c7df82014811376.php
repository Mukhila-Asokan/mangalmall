<?php echo $__env->make('admin.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
    	
    	<?php echo $__env->make('admin.layouts.sidemenu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>	
    	   
    	   <div class="page-content">
    	   		
    	   		<?php echo $__env->make('admin.layouts.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


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
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin/dashboard')); ?>"><?php echo e($pageroot ?? ' Home '); ?></a></li>
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



    	<?php echo $__env->make('admin.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    	</div>	
    </div>

<?php echo $__env->make('admin.layouts.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>






<?php echo $__env->make('admin.layouts.popup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?> 

<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<?php echo $__env->make('admin.layouts.popupscripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/layouts/app-admin.blade.php ENDPATH**/ ?>