<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="horizontal">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <title>{{ config('app.name') }}</title>
  <meta content="Mangal Mall - Venue Admin" name="description" />
  <meta content="Rel Del Mercado" name="author" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="{{ asset('venueassets/images/logo-light.png') }}" />

  <meta name="_token" content="{{ csrf_token() }}" />


  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('venueassets/css/styles.css') }}" />

  <title>Venue Admin</title>
</head>
<body>

  <!-- Preloader -->
  <div class="preloader">
    <img src="{{ asset('venueassets/images/logo-light.png') }}" alt="loader" class="lds-ripple img-fluid" />
  </div>