<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>Module: <?php echo config('venue.name'); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('venue::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/modules/venue/index.blade.php ENDPATH**/ ?>