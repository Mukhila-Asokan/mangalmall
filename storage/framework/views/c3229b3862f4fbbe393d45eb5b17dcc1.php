<?php $__env->startSection('content'); ?>


<div class="col-lg-8 col-md-8">
                        <!-- Search widget-->
    <aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
    </aside>

    <hr>  
   
<div class="row white-bg shadow-sm p-5 mt-md-4 mt-lg-4">  
    <div class="col-11"> 
     
       <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Occasion</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>                                
            </thead>
            <tbody>
                <?php
                    $i=1;
                ?>
                    <?php $__currentLoopData = $useroccasion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><p><?php echo e($i++); ?></p></td>
                            <td><p><?php echo e($occasion->occasiondate); ?></p></td>
                            <td><p><?php echo e($occasion->Occasionname->eventtypename); ?></p></td>
                            <td><p><?php echo e($occasion->notes); ?></p></td>
                            <td><a href="#"><span class="ti-pencil"></span></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
       </table>
   
    </div>
    <div class="col-1">
             <div class="text-end">
    <a type="button" class="btn primary-solid-btn" id="addoccasion" data-toggle="modal" data-target="#addoccasionpopup">Add</a></div>
    </div>
</div>
</div>





<div class="modal fade" id="addoccasionpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Occasion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method = "post" action = "<?php echo e(route('home/occasion/add')); ?>">
      <div class="modal-body">
           <?php echo csrf_field(); ?>
            <div class="form-row">
            <div class="col-12">
                <div class="form-group">
                    <input type="Date" class="form-control" name="occasiondate" id="occasiondate" placeholder="Select Date" required="required">
                </div>
                <input type = "hidden" name = "userid" value = "<?php echo e($userid); ?>" />
            </div>
            <div class="col-12">
                <div class="form-group">
                    <select class="form-control" name="occasiontype" id="occasiontype" required="required">
                        <option>Select Occasion</option>
                        <?php $__currentLoopData = $occasiontype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($typename->id); ?>" ><?php echo e($typename->eventtypename); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" rows="5" cols="25" placeholder="Notes"></textarea>
                </div>
            </div>
           
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn secondary-outline-btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn primary-solid-btn">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('profile-layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/occasion.blade.php ENDPATH**/ ?>