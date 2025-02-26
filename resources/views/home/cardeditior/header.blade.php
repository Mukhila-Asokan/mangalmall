<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $userid = 20;
        $where = ['user_id' => $userid, 'data_key' => 'siteTitle'];
        $siteTitle = \App\Models\ThemeSetting::where($where)->get();
    @endphp
    <title>{{ isset($siteTitle[0]->data_value) && !empty($siteTitle[0]->data_value) ? $siteTitle[0]->data_value : 'Admin | mangalmall Image Editor' }}</title>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/google-fonts.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('assets/images/favicon.png') }}" />
    <link rel="icon" type="image/ico" href="{{ asset('assets/images/favicon.png') }}" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/coloris.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css?q=1') }}" rel="stylesheet">
    <link href="#" id="drag_mode" rel="stylesheet">
    @php
        $where = ['data_key' => 'google_analytics_header_script'];
        $result_header_script = \App\Models\ThemeSetting::where($where)->get();
    @endphp
    @if(!empty($result_header_script[0]->data_value))
        {!! $result_header_script[0]->data_value !!}
    @endif
</head>