@extends('profile-layouts.profile')
@section('content')
<div class="container text-center">
<div class="text-center">
        <h1>Database Error</h1>
        <p>Please check the database connection.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go Home</a>
    </div>
    </div>
@endsection