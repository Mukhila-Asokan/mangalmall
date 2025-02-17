
<style>::after, ::before {box-sizing: border-box;}


.container {
    display: flex; /* Enable flexbox on the container */
    flex-direction: column; /* Stack table and pagination vertically */
    min-height: 100vh; /* Optional: Make container take full viewport height */
}

#datatable
{
    width: 100%;
    margin: 0 auto;
    clear: both;
    border-collapse: collapse;
    table-layout: fixed;
    word-wrap:break-word;
    flex: 1;
}


.pagination {
    margin-top: 20px; 
}

</style>


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-2">District</h4>
                 
                
                <div class="row mt-4">
                <div class="col-6">
                                 <a href = "<?php echo e(route('venuesettings')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-arrow-left-thick me-1"></span>Back
                           </a>
                             </div>            

                <div class="col-6 text-end">   
                <a href = "<?php echo e(route('venue.district/create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                    <span class="tf-icon mdi mdi-plus me-1"></span>Add
                    </a>
                </div>
                </div>    


     <!-- Filter and Search Form -->
     <form method="GET" action="<?php echo e(route('venue.district')); ?>" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search District" value="<?php echo e(request('search')); ?>">
            </div>

            <div class="col-md-3">
                <select name="state" class="form-control">
                    <option value="">All State</option>
                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sta->id); ?>" <?php echo e(request('state') ==  $sta->statename ? 'selected' : ''); ?> > <?php echo e($sta->statename); ?></option>
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
                <a href="<?php echo e(route('venue.district')); ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>






    <div class="container">
    <?php if(count($district) > 0): ?>
                         <div class="table-responsive">
                             
    <table class="table table-bordered table-hover mb-0" id="datatable">
        <thead class="table-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">District Name</th>
                <th class="text-center">State Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
      
        <?php
    $start = ($district->currentPage() - 1) * $district->perPage() + 1;
?>
            <?php $__currentLoopData = $district; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($start++); ?></td>
                <td><?php echo e($dist->districtname); ?></td>
                <td><?php echo e($dist->state->statename ?? ''); ?></td>
                <td><?php if($dist->status == 'Active'): ?>
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($dist->id); ?>" title="Status"><i class="fa fa-eye action_icon"></i></button>
                <?php else: ?> 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="<?php echo e($dist->id); ?>" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
                <?php endif; ?>
                <a href="<?php echo e(url('/admin/district/'.$dist->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
                </a>
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($dist->id); ?>" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                   
              
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center"> 
    <?php echo e($district->appends(request()->query())->links('pagination::bootstrap-4')); ?>


    </div>
            
            
            <?php else: ?>
                No Records Found
        <?php endif; ?>
    </div>
</div> 
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/district/')); ?>">  
<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/district/index.blade.php ENDPATH**/ ?>