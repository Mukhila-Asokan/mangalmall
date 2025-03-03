
<?php $__env->startSection('content'); ?>

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Menu</h4>
                        <div class="row">
                           
                        <div class="text-end">
                         <a href = "<?php echo e(route('admin.menu')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                          <span class="tf-icon mdi mdi-eye me-1"></span>View List
                           </a>
                        </div>
                    </div>
                    <form class="form-horizontal" role="form" method="post" action="<?php echo e(route('menu.store')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="col-6">
                        <div class="mb-4 row">
                            <label class="col-md-4 col-form-label" for="menuname">Menu Name</label>
                            <div class="col-md-8">
                                <input type="text" id="menuname" name="menuname" class="form-control" placeholder="Enter the Menu name" value="<?php echo e(old('menuname')); ?>">
                                <?php $__errorArgs = ['menuname'];
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
                            <label class="col-md-4 col-form-label" for="modelname">Model Name</label>
                            <div class="col-md-8">
                                <input type="text" id="modelname" name="modelname" class="form-control" placeholder="Enter the Model name" value="<?php echo e(old('modelname')); ?>">
                                <?php $__errorArgs = ['modelname'];
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
                            <label class="col-md-4 col-form-label" for="controllername">Controller Name</label>
                            <div class="col-md-8">
                                <input type="text" id="controllername" name="controllername" class="form-control" placeholder="Enter the Controller name" value="<?php echo e(old('controllername')); ?>">
                                <?php $__errorArgs = ['controllername'];
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
                            <label class="col-md-4 col-form-label" for="tablename">Table Name</label>
                            <div class="col-md-8">
                                <input type="text" id="tablename" name="tablename" class="form-control" placeholder="Enter the Table name" value="<?php echo e(old('tablename')); ?>">
                                <?php $__errorArgs = ['tablename'];
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
                            <label class="col-md-4 col-form-label" for="icon">Icon</label>
                            <div class="col-md-8">
                                <input type="text" id="icon" name="icon" class="form-control" placeholder="Enter the Icon" value="<?php echo e(old('icon')); ?>">
                                <?php $__errorArgs = ['icon'];
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
                            <label class="col-md-4 col-form-label" for="url">URL</label>
                            <div class="col-md-8">
                                <input type="text" id="url" name="url" class="form-control" placeholder="Enter the URL" value="<?php echo e(old('url')); ?>">
                                <?php $__errorArgs = ['url'];
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
                            <label class="col-md-4 col-form-label" for="route">Route</label>
                            <div class="col-md-8">
                                <input type="text" id="route" name="route" class="form-control" placeholder="Enter the Route" value="<?php echo e(old('route')); ?>">
                                <?php $__errorArgs = ['route'];
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
                            <label class="col-md-4 col-form-label" for="sortorder">Sort Order</label>
                            <div class="col-md-8">
                                <input type="number" id="sortorder" name="sortorder" class="form-control" placeholder="Enter the Sort Order" value="<?php echo e(old('sortorder')); ?>">
                                <?php $__errorArgs = ['sortorder'];
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
                            <label class="col-md-4 col-form-label" for="parentid">Parent Menu</label>
                            <div class="col-md-8">
                                <select id="parentid" name="parentid" class="form-control">
                                    <option value="">Select Parent Menu</option>
                                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($menu->id); ?>" <?php echo e(old('parentid') == $menu->id ? 'selected' : ''); ?>><?php echo e($menu->menuname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['parentid'];
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
                        <br><br>
                            <div class="justify-content-end row">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Menu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app-admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/admin/menu/create.blade.php ENDPATH**/ ?>