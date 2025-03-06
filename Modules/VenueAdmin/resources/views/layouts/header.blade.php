<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Mangal Mall - Venue Admin" name="description" />
        <meta content="Rel Del Mercado" name="author" />

         <meta name="_token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('venueassets/images/logo-light.png') }}">
        <link rel="stylesheet" href="{{ asset('venueasset/css/venueadmin.css') }}"></script>
        
        <!-- Theme Config Js -->
        <script src="{{ asset('venueasset/js/config.js') }}"></script>

        <!-- App css -->
        <link href="{{ asset('venueasset/css/app.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="{{ asset('venueasset/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    </head>

