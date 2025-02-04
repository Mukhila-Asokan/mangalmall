
<?php $__env->startSection('content'); ?>
<style type="text/css">
    
 
    .imageOutput img
    {
        width:200px;
        height:auto;
    }
</style>
 <link href="<?php echo e(asset('adminassets/libs/selectize/css/selectize.bootstrap3.css')); ?>" rel="stylesheet" type="text/css" />

         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Add Venue</h4>
                       
                        <div class="text-end">
                         <a href = "<?php echo e(route('admin/themebuilder')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                             <span class="tf-icon mdi mdi-eye me-1"></span>Theme Builder List
                           </a>
                        </div>
                  
                          <form class="form-horizontal" role="form" method = "post" action="<?php echo e(route('venue.themebuilder_add')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="col-6">


                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="themename">Theme Builder Name</label>
                                            <div class="col-md-8">
                                                  <input type="text" id="themename" name="themename" class="form-control" placeholder="Enter the venue Theme name" value = "<?php echo e(old('themename')); ?>" required>
                                                <?php if($errors->has('themename')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('themename')); ?></div>
                                                
                                            <?php endif; ?>
                                            </div>

                                        </div>


                                        <div class="mb-4 row">
                                            <label class="col-md-4 col-form-label" for="theme_zipfile">Theme Path</label>
                                            <div class="col-md-8">
                                                  <input type="file"  id="theme_zipfile" name="theme_zipfile" class="form-control" required>
                                                <?php if($errors->has('theme_zipfile')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('theme_zipfile')); ?></div>
                                                
                                            <?php endif; ?>
                                            </div>

                                        </div>


                                        <div class="mb-4 row">
                                              <label class="col-md-4 col-form-label" for="theme_type">Theme Option</label>
                                               <div class="col-md-8">
                                             <select class="form-select" id="theme_type" name="theme_type" aria-label="Select Theme Type">
                                                    <option selected>Select Theme type</option>
                                                    <option value = "1">One Page</option>
                                                    <option value = "2">Multi Page</option>     
                                              </select>
                                                 <?php if($errors->has('theme_type')): ?>
                                                <div class="text-danger"><?php echo e($errors->first('theme_type')); ?></div>
                                                
                                            <?php endif; ?>
                                            </div>

                                         </div>   

                                           <div class="mb-4 row">
                                         <label for="formFile" class="col-md-4 col-form-label">Preview Image Uplaod</label>
                                         <div class="col-md-8">
                                        <input class="form-control imageUpload" type="file" id="formFile" name = "preview_image">
                                    </div>
                                        </div>

                                         <div id = "categoryiconimage" class="imageOutput"></div>





                                        <br><br>
                                         <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Theme Bulider </button>
                                                </div>
                                            </div>
                                   
                                    </form>
                    </div>
                </div>
            </div>
        </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">

  $images = $('#categoryiconimage')
    $(".imageUpload").change(function(event){
        readURL(this);
       
    });
 
    function readURL(input) {

if (input.files && input.files[0]) {
    
    $.each(input.files, function() {
        var reader = new FileReader();
        reader.onload = function (e) {           
            $images.html('<img src="'+ e.target.result+'" />')
        }
        reader.readAsDataURL(this);
    });
    
}
}

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Venue\resources/views/themebuilder/create.blade.php ENDPATH**/ ?>