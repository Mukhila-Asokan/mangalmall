@extends('profile-layouts.profile')
@section('content')
<div class="container text-center">
    <div class="text-center">
        <h1>500 - Page Not Found</h1>
        <p>Sorry, the page you are looking for could not be found.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go Home</a>
    </div>
    </div>
@endsection