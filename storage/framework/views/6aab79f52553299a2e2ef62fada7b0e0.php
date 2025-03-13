<div id="group_container" class="content-section">
    <div class="card p-3 m-3  border-0">
        <div class="card-header pb-1 pr-3">
            <div class="row">
                <div class="col-md-6 d-flex">
                    <span class="font-20 font-color font-weight-bold">Caretakers</span>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between row mb-4">
            <div class="mb-2 col-7 d-flex">
                <div class="input-group">
                    <input type="text" id="search_caretaker_value" class="form-control" placeholder="Search Guest group details here..." aria-label="Search Guest details here..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" id="search_caretaker" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <button class="btn btn-primary ml-2 font-14 clear_search" type="button">Clear</button>
            </div>
        </div>
        <div class="row d-flex justify-content contact-list">
            <?php $__currentLoopData = $caretakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caretaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-3 mb-4">
                    <div class="card contact-card m-1">
                        <div class="card-header m-2">
                            <div class="row">
                                <div class="col-8 text-start d-flex">
                                    <i class="bi bi-people-fill font-14"></i>
                                    <span class="font-14 font-weight-bold ml-1"><?php echo e($caretaker->name); ?></span>
                                </div>
                                <div class="col-4 d-flex justify-content-end align-items-center">
                                    <a id="add_caretaker_guest" data-id="<?php echo e($caretaker->id); ?>" class="add_caretaker_guest pointer"><i class="bi bi-person-plus-fill font-20"></i></a>
                                    <a id="edit_caretaker_guest" class="edit_caretaker_guest ml-2 pointer" data-id="<?php echo e($caretaker->id); ?>"><i class="bi bi-pencil-square font-20"></i></a>
                                </div>
                            </div>
                        </div>
                        <hr class="m-0 p-0">
                        <div class="card-body p-2 mb-2">
                            <div class="row mt-2">
                                <div class="col-md-12 d-flex">
                                    <i class="bi bi-telephone font-12"></i>
                                    <span class="font-12 ml-1"><?php echo e($caretaker->mobile_number); ?></span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 d-flex">
                                    <i class="bi bi-envelope font-12"></i>
                                    <span class="font-12 ml-1"><?php echo e($caretaker->email); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row d-flex">
                                <div class="col-md-6 d-flex justify-content-start p-0">
                                    <a id="delete_group" class="delete_group ml-2 pointer" data-id="<?php echo e($caretaker->id); ?>">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end p-0">
                                    <button class="btn btn-primary waves-effect waves-light text-end ml-1 pl-2 pr-2 pt-1 pb-1 font-12 view_group" id="view_group" data-id="<?php echo e($caretaker->id); ?>">
                                        View Caretaker
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php if(count($caretakers) == 0): ?>
            <div class="col-12 text-center">
                <div class="">No groups found</div>
            </div>
        <?php endif; ?>
        <?php if(count($caretakers) > 30): ?>
            <div class="col-12 d-flex justify-content-center mt-4">
                <a href="" class="btn primary-solid-btn text-center load_more_groups w-25">Load More</a>
            </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\mangalmall\mangalmall\resources\views/guest/caretaker/caretaker_list.blade.php ENDPATH**/ ?>