

<?php $__env->startSection('content'); ?>

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">List of Blog Tags</h4>

                          
                        <div class="text-end">
                              <a href = "<?php echo e(route('blogtag.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
                        </div>
                   

                         <div class="table-responsive table-hover table-border">
                             <?php
                                        $start = ($blogTags->currentPage() - 1) * $blogTags->perPage() + 1;
                                    ?>
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>                                      
                                        <th>Tag Name</th>            
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($blogTags) > 0): ?>
                                    <?php $__currentLoopData = $blogTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($start++); ?></th>                                      
                                        <td><?php echo e($tag->tagname); ?></td>           
                                        
                                        
                                        <td><?php if($tag->status == 'Active'): ?>
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($tag->id); ?>" title="Active Status"><i class="fa fa-eye action_icon"></i></button>
                <?php else: ?> 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="<?php echo e($tag->id); ?>" title="Inactive Status"><i class="fa fa-eye-slash action_icon"></i></button>
                <?php endif; ?>
                <a href="<?php echo e(url('/admin/blog/tags/'.$tag->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
                </a>
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($tag->id); ?>" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                    </tr>                                             
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="4">
                                       <?php echo e($blogTags->links('pagination::bootstrap-4')); ?>


                                       </td>
                                    </tr>
                                        <?php else: ?> 
                                            <tr>
                                            <td colspan="4">
                                                No Records Found

                                            </td>
                                        </tr>   
                                        <?php endif; ?>
                                       
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/blog/tags/')); ?>">
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Blog\resources/views/blogtags/index.blade.php ENDPATH**/ ?>