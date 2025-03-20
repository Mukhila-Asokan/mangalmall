<?php use App\Models\UserChecklist; ?>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
.sortable-list {
    min-height: 200px; /* Ensures containers have enough space for drag and drop */
    background-color: #f1f1f1;
    border: 2px dashed #ddd;
    padding: 10px;
}

.checklist-item {
    cursor: move;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.ui-state-highlight {
    background-color:rgb(228, 204, 134);  /* Highlight placeholder when dragging */
    height: 50px;
    border: 2px dashed #666;
}


    </style>
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        <?php echo $__env->make('profile-layouts.sticky', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="col-lg-11 col-md-11 stickymenucontent">  
        <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center">Checklist Board</h2>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChecklistModal">
            Add New
        </a>

    </div>

    <div class="row">
    <!-- Not Yet Started -->
    <div class="col-lg-4 col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0 p-2 text-center">Not Yet Started</h5>
            </div>
            <div class="card-body droppable" id="not_started">
                <ul class="sortable-list">
                    <?php $__currentLoopData = $checklist['not_started'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="checklist-item card p-2 mb-2 d-flex align-items-center shadow-lg"
                            data-id="<?php echo e($item->id); ?>">
                            <strong><?php echo e($item->name); ?></strong>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Doing -->
    <div class="col-lg-4 col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0 p-2 text-center">Doing</h5>
            </div>
            <div class="card-body droppable" id="doing">
                <ul class="sortable-list">
                    <?php $__currentLoopData = $checklist['doing'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="checklist-item card p-2 mb-2 d-flex align-items-center shadow-lg"
                            data-id="<?php echo e($item->id); ?>">
                            <strong><?php echo e($item->name); ?></strong>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Completed -->
    <div class="col-lg-4 col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0 p-2 text-center">Completed</h5>
            </div>
            <div class="card-body droppable" id="completed">
                <ul class="sortable-list">
                    <?php $__currentLoopData = $checklist['completed'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="checklist-item card p-2 mb-2 d-flex align-items-center shadow-lg"
                            data-id="<?php echo e($item->id); ?>">
                            <strong><?php echo e($item->name); ?></strong>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>




</div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    <?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

<!-- Add Checklist Modal -->
<div class="modal fade" id="addChecklistModal" aria-labelledby="addChecklistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChecklistModalLabel">Add New Checklist Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="<?php echo e(route('checklist.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Checklist Item Name -->
                    <div class="mb-3">
                        <label for="item_name" class="form-label">Checklist Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" required>
                    </div>

                    <!-- Hidden Occasion ID -->
                    <input type="hidden" name="occasion_id" value="<?php echo e($useroccasion->occasiontypeid); ?>">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Item</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<!-- jQuery UI (Load this after jQuery) -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>/*
    function confirmStatusChange(itemId, status) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to mark this item as '${status}' status ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'No, cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with AJAX request
            $.ajax({
                url: "<?php echo e(route('checklist.updateStatus')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: itemId,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Updated!',
                        text: 'Checklist status updated successfully.',
                        icon: 'success'
                    }).then(() => location.reload());  // Refresh to reflect changes
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error'
                    });
                }
            });
        } else {
            // If user cancels, uncheck the checkbox
            $(`#checkbox_${itemId}`).prop('checked', false);
        }
    });
}
*/

// Initialize Dragula.js
$(document).ready(function () {
    $(".sortable-list").sortable({
        connectWith: ".sortable-list",
        placeholder: "ui-state-highlight",
        stop: function (event, ui) {
            const itemId = ui.item.data('id');  // Extract item ID
            const newStatus = ui.item.closest('.droppable').attr('id');  // New status from target container
            
            console.log(`Item ID: ${itemId}`);
            console.log(`New Status: ${newStatus}`);

            // AJAX request for updating checklist status
            $.ajax({
                url: "<?php echo e(route('checklist.updateStatus')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    id: itemId,
                    status: newStatus
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Updated!',
                        text: `Checklist item moved to '${newStatus}' successfully.`,
                        icon: 'success'
                    });
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update checklist status.',
                        icon: 'error'
                    });
                }
            });
        }
    }).disableSelection();
});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/eventplan/create.blade.php ENDPATH**/ ?>