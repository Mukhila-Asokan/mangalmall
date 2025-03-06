<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo e(config('app.name')); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Mangal Mall - Venue Admin" name="description" />
        <meta content="Rel Del Mercado" name="author" />

         <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('venueassets/images/logo-light.png')); ?>">
        
        <!-- Theme Config Js -->
        <script src="<?php echo e(asset('venueasset/js/config.js')); ?>"></script>

        <!-- App css -->
        <link href="<?php echo e(asset('venueasset/css/app.css')); ?>" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="<?php echo e(asset('venueasset/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    </head>

<?php /**PATH C:\xampp\htdocs\mangalmall\Modules/VenueAdmin\resources/views/layouts/header.blade.php ENDPATH**/ ?>