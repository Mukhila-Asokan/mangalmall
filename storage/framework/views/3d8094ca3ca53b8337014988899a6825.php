
<?php $__env->startSection('content'); ?>

<!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0"><?php echo $pagetitle; ?></h4>
                </div>
                <div class="col-lg-6">
                   <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Change Password</h4>
                        <p class="sub-header"> User can change the password in this page</p>

                          <div class="row">
                            <div class="col-12">
                                <div class="p-2">
                                    <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('admin.passwordupdate')); ?>">
                                        <div class="col-6">
                                        <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="oldpassword">Old Password</label>
                                            <div class="col-md-8">
                                                <input type="text" id="oldpassword" name = "oldpassword" class="form-control" value="" required>
                                            </div>
                                        </div>
                                         <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="newpassword">New  Password</label>
                                            <div class="col-md-8">
                                                <input type="text" id="newpassword" name="newpassword" class="form-control" value="" required>
                                            </div>
                                        </div>
                                           <div class="mb-2 row">
                                            <label class="col-md-4 col-form-label" for="confirmpassword">Confirm Password</label>
                                            <div class="col-md-8">
                                                <input type="text" id="confirmpassword" name="confirmpassword" class="form-control" value="" required>
                                            </div>
                                        </div>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                         </div>


                    </div>
                </div>
            </div>
        </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views\admin\password.blade.php ENDPATH**/ ?>