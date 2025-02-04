@extends('profile-layouts.profile')
<link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

   @routes 
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @inertiaHead
@section('content')
<div class="col-lg-10 col-md-10">
                        <!-- Search widget-->
     <aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
    </aside>

    <hr>  
   
    <div class="row white-bg shadow-sm p-2 mt-md-4 mt-lg-4">  
        

        <div class = "row pt-2 col-12">
            <div class="col-md-12 col-12">


             @inertia
    </div>
        </div>
    </div>
</div>



@endsection


@push('scripts')



<script src="{{ asset('adminassets/libs/selectize/js/standalone/selectize.min.js') }}"></script>

@endpush