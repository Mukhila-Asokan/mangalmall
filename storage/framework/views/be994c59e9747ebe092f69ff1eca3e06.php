
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-4">Add Invitation Web Page</h4>
                
                <div class="text-end">
                    <a href="<?php echo e(route('invitation.webpage')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                        <span class="tf-icon mdi mdi-eye me-1"></span>Invitation Web Page List
                    </a>
                </div>
                
                <form class="form-horizontal" role="form" method="post" action="<?php echo e(route('webpage.add')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="webpagename">Web Page Name</label>
                            <div class="col-md-8">
                                <input type="text" id="webpagename" name="webpagename" class="form-control" placeholder="Enter the Web Page name" value="<?php echo e(old('webpagename')); ?>" required>
                                <?php if($errors->has('webpagename')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('webpagename')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="occasiontype">Occasion Type</label>
                            <div class="col-md-8">
                                <select id="occasiontype" name="occasiontype" class="form-control" required>
                                    <option value="">Select Occasion Type</option>
                                    <?php $__currentLoopData = $occasiontype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($occasionType->id); ?>" <?php echo e(old('occasiontype') == $occasionType->id ? 'selected' : ''); ?>>
                                            <?php echo e($occasionType->eventtypename); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('occasiontype')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('occasiontype')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="preview_image">Image Preview</label>
                            <div class="col-md-8">
                                <input type="file" id="preview_image" name="preview_image" class="form-control" required>
                                <?php if($errors->has('preview_image')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('preview_image')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="imagePreview">Image Preview</label>
                            <div class="col-md-8">
                                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none;">
                            </div>
                        </div>

                        <script>
                            document.getElementById('preview_image').addEventListener('change', function(event) {
                                const [file] = event.target.files;
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const img = document.getElementById('imagePreview');
                                        img.src = e.target.result;
                                        img.style.display = 'block';
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });
                        </script>
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="pathname">Website Path</label>
                            <div class="col-md-8">
                                <input type="file" id="pathname" name="pathname" class="form-control" required>
                                <?php if($errors->has('pathname')): ?>
                                    <div class="text-danger"><?php echo e($errors->first('pathname')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Invitation Web Page</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Invitation\resources/views/invitationwebpage/create.blade.php ENDPATH**/ ?>