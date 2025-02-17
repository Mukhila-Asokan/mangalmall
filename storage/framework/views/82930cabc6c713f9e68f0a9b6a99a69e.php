

<?php $__env->startSection('content'); ?>

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">List of Occasion Type Data Fields</h4>

                          
                        <div class="text-end">
                              <a href = "<?php echo e(route('admin/occasiondatafield/create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
                        </div>
                   

    <!-- Filter and Search Form -->
    <form method="GET" action="<?php echo e(route('admin/occasiondatafield')); ?>" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search Occasion Data Field" value="<?php echo e(request('search')); ?>">
            </div>

            <div class="col-md-3">
                <select name="occasion" class="form-control">
                    <option value="">All Occasions</option>
                    <?php $__currentLoopData = $occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($occasion->id); ?>" <?php echo e(request('occasion') ==  $occasion->id ? 'selected' : ''); ?> > <?php echo e($occasion->eventtypename); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-md-3">
                <select name="sort" class="form-control">
                    <option value="">Sort by</option>
                    <option value="asc" <?php echo e(request('sort') == 'asc' ? 'selected' : ''); ?>>Alphabet A - Z</option>
                    <option value="desc" <?php echo e(request('sort') == 'desc' ? 'selected' : ''); ?>>Alphabet Z - A</option>
                </select>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?php echo e(route('admin/occasiondatafield')); ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

                         <div class="table-responsive">
                         <?php
                            $start = ($occasionDataFields->currentPage() - 1) * $occasionDataFields->perPage() + 1;
                        ?>
                             <?php if(count($occasionDataFields) > 0): ?>
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Occasion Data Field Name</th>   
                                        <th>Occasion Name</th>         
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                    <?php $__currentLoopData = $occasionDataFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datafield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($start++); ?></th>
                                        <td><?php echo e($datafield->datafieldname); ?></td>  
                                        <td><?php echo e($datafield->occasion->eventtypename); ?></td>         
                                        
                                        
                                        <td><?php if($datafield->status == 'Active'): ?>
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($datafield->id); ?>" title="Status"><i class="fa fa-eye action_icon"></i></button>
                <?php else: ?> 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="<?php echo e($datafield->id); ?>" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
                <?php endif; ?>
                <a href="<?php echo e(url('/admin/occasiondatafield/'.$datafield->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
                </a>
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($datafield->id); ?>" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                    </tr>     
                                    
                                
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                    </table>
                                       <?php echo e($occasionDataFields->links('pagination::bootstrap-4')); ?>

           <?php else: ?>
                No Records Found
        <?php endif; ?>
                           
                        </div> 
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/occasiondatafield/')); ?>">  
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/occasiondatafields/index.blade.php ENDPATH**/ ?>