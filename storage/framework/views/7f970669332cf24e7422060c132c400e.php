
<?php $__env->startSection('content'); ?>
<style>
   textarea {
    width: 100%;
    height: 450px;
}
.ck-content
{
    height: 450px;
    overflow-y: auto;
    overflow-x: hidden;
}

    </style>
<link rel="stylesheet" href="<?php echo e(asset('frontassets/css/tagify.css')); ?>" />    

<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">
        <!--feature section start-->
        <section class="feature-section ptb-50 gray-light-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading text-center mb-5">
                            <h2>Blog - Let’s Begin the Adventure!</h2>
                          
                        </div>
                    </div>
                </div>

                <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>               

                <form method="post" action="<?php echo e(route('blog.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                <div class="row">
                                       
                  
                   
                    <div class="col-md-8">  
					
					
                        <div class="mb-3">
                            <label for="blogtitle" class="form-label">Blog Title</label>
                            <input type="text" class="form-control" id="blogtitle" name = "title" placeholder="Enter the Blog Title" value = "<?php echo e(old('title')); ?>">
                            <?php $__errorArgs = ['title'];
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
                        <div class="mb-3">
                            <label for="slug" class="form-label">Blog Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" 
                            value = "<?php echo e(old('slug')); ?>">
                            <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small id="slugFeedback" class="text-danger d-none">This slug is already taken.</small>
                        </div>
                        <div class="mb-3">
                            <label for="blogcontent" class="form-label">Blog Content</label>
                            <textarea class="form-control" id="blogcontent" placeholder="Enter the Blog Content" name="content" style="height:600px;"><?php echo e(old('content')); ?></textarea>
                            <?php $__errorArgs = ['content'];
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
				 <div class="col-md-4">  
					  <div class="mb-3 text-center">
                      <img id="imagePreview" src="<?php echo e(asset('frontassets/img/preview.jpg')); ?>"  
         alt="Mangal Mall Image Preview" 
         style="width:350px"/>
					  </div>
				      <div class="mb-3">
                            <label for="blogimage" class="form-label">Banner Image</label>
                            <input class="form-control" type="file" id="blogimage" name = "image" accept="image/*">
                            <?php $__errorArgs = ['image'];
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
					                            
                      <div class="mb-3">
                        <label for="blogtags" class="form-label">Blog Tags</label>
                        <input type="text" id="tags" name="tags" />
                        <?php $__errorArgs = ['tags'];
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
					<div class="mb-3">
						<label for="blogimage" class="form-label">Blog Category</label>
						<select class="form-control" id="blogcategory" name = "category">
                            <option value="">Select Category</option>
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?> <?php echo e(old('category') ==  $category->id ? 'selected':''); ?> "><?php echo e($category->categoryname); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
                        <?php $__errorArgs = ['category'];
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
					<div class="mb-3">
						<label for="blogstatus" class="form-label">Status</label>
						<select class="form-control" id="blogcategory" name ="blogstatus">
							<option value="draft" <?php echo e(old('blogstatus') ==  'draft' ? 'selected':''); ?> >Draft</option>							
							<option value="published" <?php echo e(old('blogstatus') ==  'published' ? 'selected':''); ?>>Published</option>
							<option value="rejected" <?php echo e(old('blogstatus') ==  'rejected' ? 'selected':''); ?>>Trash</option>						
						</select>
					</div>	
					
					 <button type="submit" class="btn btn-primary">Submit</button> 
				 </div>
                   
                   
                 </div>  
					</form>
                
                               
              </div>
                        
        </section>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    <?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('ckeditor/js/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('frontassets/js/tagify.js')); ?>"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#blogcontent'))
        .catch(error => {
            console.error(error);
        });

    document.getElementById('blogimage').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;  // Update the preview image
            }
            reader.readAsDataURL(file);  // Read the uploaded file as a data URL
        }
    });


    
    
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.querySelector('#tags');
        
        var defaultTags = <?php echo json_encode($tags->pluck('tagname')->take(4), 15, 512) ?>; 

        var tagify = new Tagify(input, {
            whitelist: <?php echo json_encode($tags->pluck('tagname'), 15, 512) ?>,
            dropdown: {
                maxItems: 5,
                enabled: 0, // Always show suggestions dropdown
                closeOnSelect: false
            }
        });

        // Set default tags
        tagify.addTags(defaultTags);
    });


    $(document).ready(function () {
        // Auto-generate slug from title
        $('#title').on('input', function () {
            let title = $(this).val();
            let slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(slug);

            // Trigger uniqueness check when slug is generated
            checkSlug(slug);
        });

        // Check slug uniqueness when the user modifies the slug
        $('#slug').on('input', function () {
            let slug = $(this).val().trim();
            checkSlug(slug);
        });

        // Function to check slug uniqueness using AJAX
        function checkSlug(slug) {
            $.ajax({
                url: '<?php echo e(route("blog.check-slug")); ?>',  // Server endpoint to check slug
                method: 'GET',
                data: { slug: slug },
                success: function (response) {
                    if (response.exists) {
                        $('#slugFeedback').removeClass('d-none');
                    } else {
                        $('#slugFeedback').addClass('d-none');
                    }
                }
            });
        }
    });


</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/blog/create.blade.php ENDPATH**/ ?>