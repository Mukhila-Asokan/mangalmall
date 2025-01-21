@extends('venueadmin::layouts.auth-layout')
@section('content')

<div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
  <div class="auth-max-width col-sm-8 col-md-6 col-xl-7 px-4">
    <h2 class="mb-1 fs-7 fw-bolder text-center">Welcome to Mangal Mall</h2>
    <h5 class="mb-7 text-center mb-5">Venue Portal</h5>
    	<p class="badge text-bg-info">Please contact Mangal Mall team to activate your account</p>

    	 <br> 
      <div class="d-flex align-items-center justify-content-center">
        <p><a class="text-primary fw-medium ms-2" href="{{ route('venue/login') }}">Login in Here</a></p>
      </div>
   </div>
 </div>

@endsection