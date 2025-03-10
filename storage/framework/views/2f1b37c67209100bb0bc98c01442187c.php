<?php $__env->startSection('content'); ?>

<section class="ptb-100 height-lg-100vh d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center pt-5 pt-sm-5 pt-md-5 pt-lg-0">
            <div class="col-md-6 col-lg-5">
                <div class="card login-signup-card shadow-lg mb-0">
                    <div class="card-body px-md-5 py-5">
                        <div class="mb-5">
                            <h5 class="h3">Create account</h5>
                        </div>
                        <form class="login-signup-form" method="POST" action="<?php echo e(route('register/add')); ?>">
                            <?php echo csrf_field(); ?>

                            <?php if(session('error')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session('error')); ?>

                                    </div>
                                     <?php endif; ?>

                            <div class="form-group">
                                <label class="pb-1">Your Name</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-user color-primary"></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter your name" name="name" value="<?php echo e(old('name')); ?>" required>
                                </div>
                                <?php $__errorArgs = ['name'];
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
                            <div class="form-group">
                                <label class="pb-1">Email Address</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-email color-primary"></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="name@address.com" name="email" value="<?php echo e(old('email')); ?>" required>
                                </div>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="text-danger"><?php echo e($message); ?></span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label class="pb-1">Password</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock color-primary"></span>
                                    </div>
                                    <input type="password"  id="password" class="form-control" placeholder="Enter your password" name="password" required>
                                    <div class="input-group-append">
                                                <span class="input-group-text" id="togglePassword" onclick="togglePassword()" style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="eye-icon"></i>
                                                </span>
                                            </div>
                                </div>
                                <?php $__errorArgs = ['password'];
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

                             <div class="form-group">
                                <label class="pb-1">Confirm Password </label>
                                <div class="input-group input-group-merge">
                                    <div class="input-icon">
                                        <span class="ti-lock color-primary"></span>
                                    </div>
                                      <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required>
                                </div>
                               <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            

                            <div class="my-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="check-terms" name="terms" checked>
                                    <label class="custom-control-label" for="check-terms">I agree to the <a href="#">terms and conditions</a></label>
                                </div>
                            </div>
                            <button class="btn btn-block primary-solid-btn border-radius mt-4 mb-3">
                                Sign up
                            </button>
                        </form>
						</div>
                    </div>
                    <div class="card-footer px-md-5 bg-transparent border-top">
                        <small>Already have an account?</small>
                        <a href="<?php echo e(route('login')); ?>" class="small">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>    
<script>
   
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash"); // Eye slash icon
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye"); // Regular eye icon
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/auth/register.blade.php ENDPATH**/ ?>