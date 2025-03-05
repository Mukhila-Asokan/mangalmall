@extends('profile-layouts.profile')
@section('content')
<div class="col-lg-10 col-md-10 shadow-sm">
    <!--pricing section start-->
    <section class="pricing-section ptb-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="section-heading text-center mb-5">
                            <h2>Pricing</h2>
                            <p class="lead">
                                Distinctively recaptiualize principle-centered core competencies through client-centered core competencies. Enthusiastically provide access to pricing details for the venue, invitation design, guest management, and blog features.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($subcriberplan as $plan)
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="card text-center single-pricing-pack">
                            <div class="pt-5">
                                <h5 class="mb-0">{{ $plan->name }}</h5>
                                <p></p>
                            </div>
                            <div class="card-header pb-4 border-0 pricing-header">
                                <div class="price text-center mb-0"> {{ $plan->price }}<span>/month</span></div>
                            </div>
                            <div class="card-body">
                                {!! $plan->description !!}
                                <a href="#" class="btn outline-btn mb-3 mt-3" target="_blank">Purchase now</a>
                            </div>
                            
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--pricing section end-->
</div>
<div class="col-lg-2 col-md-2">

@include('profile-layouts.rightside')
</div>
@endsection