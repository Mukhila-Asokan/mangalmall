<!--blog-section section start-->
<section class="feature-promo-seciton ptb-50">
        <div class="container">
            <div class="row justify-content-center">

            <?php $__currentLoopData = $userblog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                <div class="single-blog-card card border-0 shadow-sm">
                        <span class="category position-absolute badge badge-pill badge-primary"><?php echo e($blog->category->categoryname ?? 'No Category'); ?></span>
                        <img src="<?php echo e(url('/').Storage::url($blog->image)); ?>" class="card-img-top position-relative" alt="blog">
                        <div class="card-body">
                            <div class="post-meta mb-2">
                                <ul class="list-inline meta-list">
                                    <li class="list-inline-item"><?php echo e($blog->created_at->format('F d, Y')); ?></li>
                                    <li class="list-inline-item"><span class="fas fa-comments"></span> <span><?php echo e($blog->comments); ?></span></li>
                                    <li class="list-inline-item"><span class="fas fa-thumbs-up"></span> <span><?php echo e($blog->likes); ?></span></li>
                                    <li class="list-inline-item"><span class="fas fa-eye"></span> <span><?php echo e($blog->views); ?></span> </li>
                                </ul>
                            </div>
                            <h3 class="h5 card-title"><a href="<?php echo e(route('guestblog.show', $blog->id)); ?>"><?php echo e($blog->title); ?></a></h3>
                            
                            <a href="<?php echo e(route('guestblog.show', $blog->id)); ?>" class="detail-link">Read more <span class="ti-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
</section><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/layouts/blog.blade.php ENDPATH**/ ?>