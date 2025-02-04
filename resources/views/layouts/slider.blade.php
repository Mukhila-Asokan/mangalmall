<!--hero section start-->
@php
        $url1 = "frontassets/img/hero-17.jpg";
		$urlbg = "frontassets/img/bg1.png";
		
	@endphp

        <section class="hero-slider-section ptb-20" style="background: url('{{ asset($urlbg) }}')no-repeat" >
            <div class="owl-carousel owl-theme hero-slider-one custom-dot dot-right-center">
                <div class="item">
                    <div class="hero-equal-height ptb-100" 
                    style="background: url('{{ asset($url1) }}')no-repeat center center / cover">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8">
                                    <div class="hero-content-wrap text-white position-relative z-index">
                                       
                                  
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				@php
		$url2 = "frontassets/img/hero-10.jpg";
		
	@endphp
                <div class="item">
                    <div class="hero-equal-height ptb-100" style="background: url('{{ asset($url2); }}')no-repeat center center / cover">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8">
                                    <div class="hero-content-wrap text-white">
                                      
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
						@php
		$url3 = "frontassets/img/hero-4.jpg";
		
	@endphp
				
                <div class="item">
                    <div class="hero-equal-height ptb-100" style="background: url('{{ asset($url3); }}')no-repeat center center / cover">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8">
                                    <div class="header-content text-white">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
							@php
		$url4 = "frontassets/img/hero-5.jpg";
		
	@endphp
                  <div class="item">
                    <div class="hero-equal-height ptb-100" style="background: url('{{ asset($url4); }}')no-repeat center center / cover">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-lg-8">
                                    <div class="header-content text-white">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--hero section end-->