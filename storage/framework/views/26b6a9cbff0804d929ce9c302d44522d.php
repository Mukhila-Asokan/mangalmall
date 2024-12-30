<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="light" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title><?php echo e(config('app.name')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Occasion Pannel" name="description" />
    <meta content="Rel Del Mercado" name="author" />

    <meta name="_token" content="<?php echo csrf_token(); ?>" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="<?php echo e(asset('adminassets/libs/morris.js/morris.css')); ?>" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?php echo e(asset('adminassets/css/style.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('adminassets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo e(asset('adminassets/assets/js/config.js')); ?>"></script>
</head>
<body><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views\admin\layouts\header.blade.php ENDPATH**/ ?>