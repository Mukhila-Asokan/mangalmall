
<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Event for Checklist</h4>
            
            <div class="text-end">
                <a href = "<?php echo e(route('admin.eventchecklist.index')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Checklist List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('admin.eventchecklist.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="col-6">
      
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="occasion_id">Occasion</label>
                <div class="col-md-8">
                    <select id="occasion_id" name="occasion_id" class="form-control">
                        <option value="">Select Occasion</option>
                        <?php $__currentLoopData = $occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($occasion->id); ?>" <?php echo e(old('occasion_id') == $occasion->id ? 'selected' : ''); ?>><?php echo e($occasion->eventtypename); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['occasion_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="category_id">Checklist Category</label>
                <div class="col-md-8">
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="mb-4 row">
    <label class="col-md-4 col-form-label">Checklist Items</label>
    <div class="col-md-8">
        <ul id="checklist_items" class="list-group">
            <!-- Checklist items will be loaded here -->
        </ul>
    </div>
</div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Event Checklist</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
   

        $('#category_id').on('change', function() {
            var categoryId = $(this).val();

            // Clear previous checklist items
            $('#checklist_items').empty();

            if (categoryId) {
                $.ajax({
                    url: "<?php echo e(route('admin.checklistitems.get')); ?>", // Create this route
                    type: 'GET',
                    data: { "_token": "<?php echo e(csrf_token()); ?>", category_id: categoryId },
                    success: function(response) {
                        if (response.success) {
                            if (response.items.length > 0) {
                                $.each(response.items, function(index, item) {
                                    $('#checklist_items').append(`<li class="list-group-item">${item.item_name}</li>`);
                                });
                            } else {
                                $('#checklist_items').append(`<li class="list-group-item">No checklist items found.</li>`);
                            }
                        } else {
                            $('#checklist_items').append(`<li class="list-group-item text-danger">Error loading items.</li>`);
                        }
                    },
                    error: function() {
                        $('#checklist_items').append(`<li class="list-group-item text-danger">Failed to fetch items.</li>`);
                    }
                });
            }
        });
    });
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Settings\resources/views/eventchecklist/create.blade.php ENDPATH**/ ?>