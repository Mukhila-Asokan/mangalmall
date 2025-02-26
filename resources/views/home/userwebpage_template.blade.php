@extends('profile-layouts.profile')

@section('content')


<div class="col-lg-8 col-md-8">
<aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
</aside>

<div class="container py-5">
        <h5 class="mb-4 text-center text-primary">Make a Website for Your Event</h5>

        <div class="row">

                     
        @foreach($template as $webpage)
        <div class="col-md-4">
                <div class="card">
                <div class="card-body">
                <h5 class="card-title
                ">Choose a Template</h5>
                @php
                $userid = Auth::user()->id;
                $preview_imageurl = url("home/webpage/".$webpage->id."/preview");
                $editorurl = url("home/webpage/".$userid."/".$webpage->id."/editor");
                @endphp

                <a href ="{{ $preview_imageurl }}" target="_new"><img src="{{ asset('storage/' . $webpage->preview_image) }}" style = "width:100%"/></a>
                </div> 
                <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                                <h6 class="card-title text-center">{{ $webpage->webpagename }}</h6>
                        </div>
                        <div>
                                <a href="{{ $editorurl }}" target="_new" class="btn btn-danger">Use</a>
                        </div>
                        </div>
                 </div>
               
                </div>
        </div>
                
        @endforeach
                  
    
        
</div>


</div>
<div class="col-lg-2 col-md-2"></div>
@endsection
@push('scripts')


@endpush