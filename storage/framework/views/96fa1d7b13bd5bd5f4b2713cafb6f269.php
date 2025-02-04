
<?php $__env->startSection('content'); ?>



         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-2">Venue Theme Builder</h4>


                      
                         
                        <div class="text-end">   
                        <a href = "<?php echo e(route('themebuilder/create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-plus me-1"></span>Add
                           </a>
                        </div>
                    

                         <div class="table-responsive">
                             
                            <table class="table mb-0 data-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Theme Name</th>
                                        <th>Theme Type</th>
                                        <th>Preview Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/venue/themebuilder/')); ?>">  

<?php $__env->startPush('scripts'); ?>
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
  $(function () {
        
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(route('admin/themebuilder')); ?>",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'themename', name: 'themename'},
            {data: 'theme_type', name: 'theme_type'},
            {data: 'preview_image', name: 'preview_image'},           
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
        
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/themebuilder/index.blade.php ENDPATH**/ ?>