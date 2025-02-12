<?php $__env->startSection('content'); ?>


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Venue Data Field</h4>

                          
                        <div class="text-end">
                              <a href = "<?php echo e(route('venuesettings/datafield/create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end"><span class="tf-icon mdi mdi-plus me-1"></span> Add </a>
                        </div>
                   

                         <div class="table-responsive">
                             <?php $i=1; ?>
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Data Field Name</th>
                                        <th>Field Type</th>
                                        <th>Field Units</th>
                                        <th>Field Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($venuedatafield) > 0): ?>
                                    <?php $__currentLoopData = $venuedatafield; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($i++); ?></th>
                                        <td><?php echo e($typename->datafieldname); ?></td>           
                                        <td><?php echo e($typename->datafieldnametype); ?></td>
                                        <td><?php echo e($typename->datafieldtype); ?></td>
                                        <td>

                                            <?php

                                                $data = $typename->datafieldvalues;

                                                if($data!="")
                                                {
                                                $jsonData = json_decode($data, true); 
                                                $j = 1;
                                                foreach($jsonData as $item):
                                                    echo $j.". ".$item['optionname']."<br>";
                                                    $j++;
                                                endforeach;
                                                }
                                                
                                            ?>


                                           </td>
                                        <td><?php if($typename->status == 'Active'): ?>
                    <button type="button" class="btn btn-primary statusid" data-bs-toggle="modal"  data-bs-target=".statusModal"  data-id="<?php echo e($typename->id); ?>" title="Status"><i class="fa fa-eye action_icon"></i></button>
                <?php else: ?> 
                <button type="button" class="btn-info btn statusid" data-bs-toggle="modal"  data-bs-target=".statusModal" data-id="<?php echo e($typename->id); ?>" title="Status"><i class="fa fa-eye-slash action_icon"></i></button>
                <?php endif; ?>
                <a href="<?php echo e(url('/admin/venuesettings/datafield/'.$typename->id.'/edit')); ?>" class="btn-warning btn" title="Edit"><i class="fa fa-pencil action_icon"></i>
                </a>
                 <button type="button" class="btn-danger btn deleteid" data-bs-toggle="modal"  data-bs-target="#delModal" data-id="<?php echo e($typename->id); ?>" title="Delete"  >
                    <i class="fa fa-trash action_icon"></i>
                </button>
           </td>
                                    </tr>                                             
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                       <?php echo e($venuedatafield->links('pagination::bootstrap-4')); ?>

           <?php else: ?>
                No Records Found
        <?php endif; ?>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<input type="hidden" name="redirecturl" id="redirecturl" value="<?php echo e(url('/admin/venuesettings/datafield/')); ?>">  


<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/venuedatafield/list.blade.php ENDPATH**/ ?>