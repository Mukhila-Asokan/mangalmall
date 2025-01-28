<!DOCTYPE html>
<html lang="en" data-bs-theme="light" >

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Occasion Pannel" name="description" />
    <meta content="Rel Del Mercado" name="author" />
    <meta name="_token" content="{!! csrf_token() !!}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('adminassets/css/style.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('adminassets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('adminassets/js/config.js') }}"></script>
</head>
<body>
    <div style="background-color: #f8b67c!important;">
         @yield('content')
    </div>
     <!-- App js -->
    <script src="{{ asset('adminassets/js/vendor.min.js') }}"></script>

</body>

</html>