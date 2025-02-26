
<?php $__env->startSection('content'); ?>
<style type="text/css">
    table
    {
        color:#000;
    }
</style>


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Venue List</h4>
                       
                        <div class="text-end">
                         <a href = "<?php echo e(route('venue/create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-plus me-1"></span>Add Venue
                           </a>
                        </div>
                    
                     <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                           <div class="text-end">
                         <a href = "<?php echo e(route('venue/index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>List Venue
                           </a>
                        </div>
                        <div class="row">
                        <div class="col-12">
                              <div class="row row-cols-1 row-cols-md-3 g-3">
                            <?php $__currentLoopData = $theme; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                                    <div class="col">
                                        <div class="card">
                                    <?php 

                                         $preview_imageurl = url("admin/venue/themebuilder/".$row->id."/preview");

                                          $url = url('/').Storage::url('/').$row->preview_image;
                                          $editorurl = url("admin/venue/themebuilder/".$venueid."/".$row->id."/editor");
                                    ?>
                                    <a href ="<?php echo e($preview_imageurl); ?>" target="_new"><img src = "<?php echo e($url); ?>" class="card-img-top"/></a>
                                </div>
                                    <div class="card-body">
                                                <h3 class="card-title text-center"><?php echo e($row->themename); ?></h3>
                                                 <a href ="<?php echo e($editorurl); ?>" target="_new" class="btn btn-success">Use</a>
                                            </div>

                                </div>

                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
                                                </div>
                        </div>
              




                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venues/themelistview.blade.php ENDPATH**/ ?>