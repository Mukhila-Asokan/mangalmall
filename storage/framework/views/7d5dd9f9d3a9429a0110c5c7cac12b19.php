<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>Module: <?php echo config('blog.name'); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('blog::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\Modules/Blog\resources/views/index.blade.php ENDPATH**/ ?>