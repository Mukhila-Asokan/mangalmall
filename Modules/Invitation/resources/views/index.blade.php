@extends('invitation::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('invitation.name') !!}</p>
@endsection
