
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">

         <!--why choose us section start-->
         <section class="why-choose-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading mb-5">
                            <h2>Hello, Curious Minds!</h2>
                            <h6>Unveiling Ideas, Insights, and Inspiration</h6>
                        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-newspaper text-white"></span>
                                </div>
                                <h5>Blog Count</h5>
                                <p id = "blogcount"><?php echo e($blogcount); ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-eye text-white"></span>
                                </div>
                                <h5>Views Count</h5>
                                <p id = "viewcount"><?php echo e($viewcount); ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-thumbs-up text-white"></span>
                                </div>
                                <h5>Likes</h5>
                                <p id = "likescount"><?php echo e($likescount); ?></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-comments text-white"></span>
                                </div>
                                <h5>Total Comments</h5>
                                <p id = "totalcomments"><?php echo e($commentscount); ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>


            <!--blog section start-->
        <section class="our-blog-section gray-light-bg mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading mb-5">
                            <h2>Our Blog List</h2>
                          
                                <a href = "<?php echo e(route('blog.create')); ?>" class="btn btn-primary waves-effect waves-light mb-4 text-end" style = "float:right"><span class="fas fa-pencil text-white"></span> Add Blog </a> 
</div>
                       
                    </div>
                </div>
                <div class="row">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <div class="col-md-4">
    <div class="single-blog-card card border-0 shadow-sm position-relative">
        
        <!-- Category Badge -->
        <span class="category position-absolute badge badge-pill badge-primary">
            <?php echo e($blog->category->categoryname ?? 'No Category'); ?>

        </span>

        <!-- Blog Image -->
        <div class="blog-image-wrapper">
            <img src="<?php echo e(url('/').Storage::url($blog->image)); ?>" class="card-img-top position-relative" alt="blog">

            <!-- Edit / Delete Icons (Hidden by Default, Show on Hover) -->
            <div class="blog-icons">
                <a href="<?php echo e(route('blog.edit', $blog->id)); ?>" class="btn btn-sm btn-warning mx-1" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="<?php echo e(route('blog.destroy', $blog->id)); ?>" class="d-inline" 
                      onsubmit="return confirm('Are you sure you want to delete this blog?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="post-meta mb-2">
                <ul class="list-inline meta-list">
                    <li class="list-inline-item"><?php echo e($blog->created_at->format('F d, Y')); ?></li>
                    <li class="list-inline-item"><span class="fas fa-comments"></span> <span><?php echo e($blog->comments); ?></span></li>
                    <li class="list-inline-item"><span class="fas fa-thumbs-up"></span> <span><?php echo e($blog->likes); ?></span></li>
                    <li class="list-inline-item"><span class="fas fa-eye"></span> <span><?php echo e($blog->views); ?></span></li>
                </ul>
            </div>
            <h3 class="h5 card-title">
                <a href="<?php echo e(route('blog.show', $blog->id)); ?>"><?php echo e($blog->title); ?></a>
            </h3>
            
            <a href="<?php echo e(route('blog.show', $blog->id)); ?>" class="detail-link">Read more <span class="ti-arrow-right"></span></a>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </section>
             

       
    </div>
</div>
<div class="col-lg-2 col-md-2">
    <?php echo $__env->make('profile-layouts.rightside', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/blog/index.blade.php ENDPATH**/ ?>