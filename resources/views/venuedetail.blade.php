@extends('profile-layouts.profile')
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<style>
   
    .carousel img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
	.bg-flower-bot {
        position: absolute;
        bottom: 0px;
        left: 0;
        opacity: .2;
        z-index: -1;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        pointer-events: none;
    }

    img {  
  transition: transform 0.25s ease;
  cursor: zoom-in;
}


img.zoomed {
  cursor: zoom-out;
}
.tab-pane.active {
    display: flex !important;
    justify-content: center !important;
}
</style>

@section('content')

@php 

	$bannerurl =  url('/').Storage::url('/').$venuedetail->bannerimage;

@endphp
<div class="col-lg-10 col-md-10">
  <!--page header section start-->
        <section class="page-header-section ptb-20 gradient-overly-right" 
        style="background: url('{{ $bannerurl }}')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 col-lg-6">
                        <div class="page-header-content text-white">
                            <h1 class="text-white mb-2">{{ $venuedetail->venuename }}</h1>                          
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--page header section end-->



<!--breadcrumb bar start-->
<div class="breadcrumb-bar py-3 gray-light-bg border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="custom-breadcrumb">
                    <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0 pl-0">
                        <li class="list-inline-item breadcrumb-item"><a href="#">Home</a></li>
                        <li class="list-inline-item breadcrumb-item"><a href="{{ route('venuereact.search') }}">Venue </a></li>
                        <li class="list-inline-item breadcrumb-item active">{{ $venuedetail->venuename }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumb bar end-->

  <div class="module ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                            <div class="post-preview">
                                <div class="carousel">
                                <img src="{{ $bannerurl }}" alt="article" class="img-fluid" style="max-height:400px" />
                                <img src="{{ $bannerurl }}" alt="article" class="img-fluid" style="max-height:400px" />
								</div>
							</div>
					</div>

                    <div class="col-lg-6 col-md-6">
                        <div class="post-wrapper">
                            <div class="post-header">
                                <h1 class="post-title">{{ $venuedetail->venuename }}</h1>
                                <div class="d-inline-flex">
                                    <div class="rating pl-2 pr-2 rounded ml-0 mt-2 mb-2" style="background: #58111A;">
                                        <span class="text-white ms-2"><i class="bi bi-star-fill" style="color: gold;"></i> {{$ratingAvg}}</span>
                                    </div>
                                    <span class="ml-1 mt-2 text-muted" style="font-size:13px;">({{$ratingCount}})</span>
                                </div>
								<p><small>{{ $venuedetail->venueaddress }} ,  <br> {{ $venuedetail->indianlocation->Areaname }} {{ $venuedetail->indianlocation->City }}, {{ $venuedetail->indianlocation->District }}<br>{{ $venuedetail->indianlocation->State }}</small></p>
								
								 
								
								 
								  <div class="d-inline-flex">
								
									<div class="p-2 justify-content-start"> 
									<h5> <i class = "fa fa-indian-rupee-sign"></i> {{ $venuedetail->bookingprice }} </h5>
									</div>
								 </div>
								 <br>
									
								
								 
								 <div class="d-inline-flex">
									<div class="p-2 justify-content-start"> 
										<h6>Capacity</h6>
									</div>
									<div class="p-2 justify-content-start"> 
									<h6>{{ $venuedetail->capacity }}</h6>
									</div>
									<div class="p-2 justify-content-end"> 
										<h6>Food Type</h6>
									</div>
									<div class="p-2 justify-content-start"> 
									<h6>{{ $venuedetail->food_type }}</h6>
									</div>
								 </div>
								 <br>
								 
									<hr>
								
								 
								
							</div>
						</div>
						<div class="bg-flower-bot">
                      <img src="{{ asset('frontassets/img/flower.png') }}">
            </div>
					</div>
					</div>
				<div class="row">
                     <div class="col-lg-12 col-md-12"> 
						<div class="post-content">
                            <div class="container">
                            <div class="row justify-content-center">
                                <ul class="nav nav-tabs feature-tab feature-new-tab justify-content-center mb-3 border-bottom-0" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" href="#feature-tab-1" data-toggle="tab">
                                        <h6 class="mb-0">Contact Details</h6>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="#feature-tab-2" data-toggle="tab">
                                        <h6 class="mb-0">Key Features</h6>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="#feature-tab-3" data-toggle="tab">
                                        <h6 class="mb-0">Amenities</h6>
                                    </a>
                                </li>
								<li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="#feature-tab-4" data-toggle="tab">
                                        <h6 class="mb-0">Description</h6>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="#feature-tab-5" data-toggle="tab">
                                        <h6 class="mb-0">Google Map</h6>
                                    </a>
                                </li>
                            </ul>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                            <div class="col-md-8 ml-5">
                                <div class="tab-content feature-tab-content row">
                                        <div class="tab-pane active" id="feature-tab-1">  
                                            <div class="row p-0 m-0">
                                                <div class="col-md-12 col-lg-12">

                                                <ul class="list-unstyled tech-feature-list">
                                                    <li class="py-1"><span class="ti-control-forward mr-2 color-primary"></span>Contact Person - {{ $venuedetail->contactperson }}</li>
                                                    <li class="py-1"><span class="ti-control-forward mr-2 color-primary"></span>Contact Mobile - {{ $venuedetail->contactmobile }}</li>
                                                    <li class="py-1"><span class="ti-control-forward mr-2 color-primary"></span>Office Number - {{ $venuedetail->contacttelephone }}</li>
                                                    <li class="py-1"><span class="ti-control-forward mr-2 color-primary"></span>Email - {{ $venuedetail->contactemail }}</li>
                                                    <li class="py-1"><span class="ti-control-forward mr-2 color-primary"></span>Website - {{ $venuedetail->websitename }}</li>
                                                    
                                                </ul>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="feature-tab-2">  
                                            <div class="row p-0 m-0">
                                                <div class="col-md-12 col-lg-12">
                                            

                                            
                                                <ul class="list-unstyled tech-feature-list">
                                                    <?PHP
                                                    $venuedataarray = json_decode($venuedetail->venuedata, true); 
                                                    $i=0;
                                                    foreach($venuedatafield as $datafield):

                                                        $value = $venuedatafielddetails->firstWhere('id',$venuedataarray[$i])->optionname ?? $venuedataarray[$i];
                                                        
                                                        echo '<li class="py-1"> <span class="ti-control-forward mr-2 color-primary"></span>'.$datafield->datafieldname.' - '.$value.' '.$datafield->datafieldnametype.'</li>';

                                                    
                                                    $i++;
                                                    endforeach;

                                                ?>
                                                    
                                                </ul>
                                        
                                                </div>
                                            </div>

                                        </div>   
                                        
                                        <div class="tab-pane" id="feature-tab-3">  
                                            <div class="row p-0 m-0">
                                                <div class="col-md-12 col-lg-12">
                                                
                                                    <ul class="list-unstyled tech-feature-list">
                                                            <?PHP

                                                            $amenitiesarray = json_decode($venuedetail->venueamenities, true); 
                                                            

                                                            foreach($venueamenities as $amenities):
                                                                
                                                                if(in_array($amenities->id, $amenitiesarray))
                                                                {
                                                                    echo '<li class="py-1"> <span class="ti-control-forward mr-2 color-primary"></span>'.$amenities->amenities_name.'</li>';
                                                                }
                                                            endforeach;

                                                        ?>
                                                            
                                                        </ul>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="tab-pane" id="feature-tab-4">  
                                            <div class="row p-0 m-0">
                                                <div class="col-md-12 col-lg-12">
                                                {!! $venuedetail->venuecontent->first()->description ?? '' !!}	
                                                    <h6>Key Features</h6>
                                                {!! $venuedetail->venuecontent->first()->key_features ?? null !!}<br> 
                                                <h6>Ambience</h6>
                                                {!! $venuedetail->venuecontent->first()->ambience ?? null !!}
                                                <br>
                                                <h6>Event Sustability</h6>
                                                {!! $venuedetail->venuecontent->first()->event_sustability ?? null !!}
                                                <br>
                                                <h6>Amenities</h6>
                                                {!! $venuedetail->venuecontent->first()->amenities ?? null !!}
                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="feature-tab-5">  
                                            <div class="row p-0 m-0">
                                                <div class="col-md-12 col-lg-12">
                                                    <iframe 
                                                        src="{{$venuedetail->googlemap}}" 
                                                        width="600" 
                                                        height="300" 
                                                        style="border:0;" 
                                                        allowfullscreen="" 
                                                        loading="lazy">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </div>
                        </div>
                                   
                                  
                                  <br>
                                </div>
                              
						</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						  <div id="calendar-component"></div>
					</div>
					<div class="col-md-6 col-lg-6">
						<h6>Image Gallery</h6>

                        @foreach($venuedetail->venueimage->where('image_type', 'gallery') as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail gallery" width="150">               
                        @endforeach
						
						<div class="bg-flower-bot">
                      <img src="{{ asset('frontassets/img/palanquim.png') }}">
					</div>
					</div>
					
				</div>
				<div class="row">
                             

    


<div class="col-12 pt-4">
      
<div class="comments-area">
    <!-- <h5 class="comments-title">Comments</h5>
    <div class="comment-list">
    </div> -->

    
    <!-- Star Rating -->
    <div class="mb-3">
        <label class="form-label"><strong>Rate this Venue :</strong></label>
        <!-- <div class="star-rating">
            <i class="fa fa-star overall-star" data-value="1"></i>
            <i class="fa fa-star overall-star" data-value="2"></i>
            <i class="fa fa-star overall-star" data-value="3"></i>
            <i class="fa fa-star overall-star" data-value="4"></i>
            <i class="fa fa-star overall-star" data-value="5"></i>
        </div>
        <p class="mt-1">Your Rating: <span id="rating-value">0</span>/5</p> -->
        <div class="star-rating row">
            <div class="col-2 p-0 m-0">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
            </div>
        </div>
        <p>Rating: <span id="rating-value">{{$venueRating->rating ?? 0}}</span>/5</p>
    </div>

    <div class="comment-respond">
        <h5 class="comment-reply-title">Leave your Comments</h5>
        <p class="comment-notes"></p>
        <form action="{{ route('venue.post.comments') }}" method="post" class="comment-form row">
            @csrf
            <div class="form-group col-md-12">
                <textarea class="form-control" rows="8" placeholder="Comments" name="comments">{{$venueRating->review ?? null}}</textarea>
            </div>
            <input type="hidden" id="venue_rating" name="rating" value="{{ $venueRating->rating ?? 0 }}">
            <input type="hidden" name="venue_id" value="{{ $venuedetail->id }}">
            <div class="form-submit col-md-12">
                <button class="btn primary-solid-btn" type="submit">Post Comment</button>
            </div>
        </form>
    </div>               

</div>

</div>
</div>     




      </div>
   </div>
   <div class="bg-flower-bot">
        <img src="{{ asset('frontassets/img/flower1.png') }}">
	</div>
                     
 </div> 
   
  
@endsection
@push('scripts')


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Initialize Carousel -->
    <script>
        $(document).ready(function(){
            $('.carousel').slick({
                dots: true, // Show dot indicators
                infinite: true, // Infinite looping
                speed: 300, // Transition speed
                slidesToShow: 1, // Number of slides to show at a time
                adaptiveHeight: true, // Adjust height based on slide content
                autoplay: true, // Auto-play the carousel
                autoplaySpeed: 2000, // Auto-play speed in milliseconds
            });
        });
        
        $(document).ready(function() {
            let rating = $("#rating-value").text();
            updateStars(rating);
            $(".star").hover(function() {
                let value = $(this).data("value");
                $(".star").each(function() {
                    $(this).toggleClass("active", $(this).data("value") <= value);
                });
            });

            $(".star").click(function() {
                rating = $(this).data("value");
                $("#rating-value").text(rating);
                $('#venue_rating').val(rating);
                $(".star").removeClass("selected");
                $(this).addClass("selected");
                $.ajax({
                    url: "{{ route('venue-ratings.store') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "rating": parseInt(rating),
                        "venue_id": parseInt("{{ $venuedetail->id }}")
                    },
                    success: function(response) {
                        console.log(response);
                    }
                })
            });

            $(".star-rating").mouseleave(function() {
                $(".star").removeClass("active");
                $(".star").each(function() {
                    $(this).toggleClass("active", $(this).data("value") <= rating);
                });
            });
        });

        function updateStars(value) {
            $("#rating-value").text(value);
            $('#venue_rating').val(value);
            $(".star").each(function() {
                $(this).toggleClass("active", $(this).data("value") <= value);
            });
        }

        document.querySelectorAll('img').forEach(i => {
        i.addEventListener('click', evt => {
            if (i.classList.contains('zoomed'))
            i.style.transform = ''
            else {
            const myScale = 500 / i.clientWidth
            i.style.transform = `scale(${myScale})`
            }
            i.classList.toggle('zoomed')
        });
        });

        document.addEventListener('DOMContentLoaded', function() {

        });


    </script>
@viteReactRefresh
@vite('resources/js/app.jsx')

@endpush