@extends('settings::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('settings.name') !!}</p>
@endsection
