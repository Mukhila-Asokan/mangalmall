<?php $__env->startSection('content'); ?>
 <section class="ptb-100 height-lg-100vh d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center pt-5 pt-sm-5 pt-md-5 pt-lg-0">
                    <div class="col-md-6 col-lg-5">
                        <div class="card login-signup-card shadow-lg mb-0">
                            <div class="card-body px-md-5 py-5">
								  <div class="mb-5">
                                    <h5 class="h3">Verify Your Email</h5>
                                    <p class="text-muted mb-0">Registration</p>
                                </div>
  
    <form method="POST" action="<?php echo e(route('otp.verify.submit')); ?>">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="otp">Enter OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" required>
            <?php $__errorArgs = ['otp'];
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
        <button type="submit" class="btn btn-block primary-solid-btn border-radius mt-4 mb-3">Verify</button>
    </form>
</div>
                            <div class="card-footer bg-transparent px-md-5"><small>Not registered?</small>
                                <a href="<?php echo e(route('register')); ?>" class="small"> Create account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/auth/verify-otp.blade.php ENDPATH**/ ?>