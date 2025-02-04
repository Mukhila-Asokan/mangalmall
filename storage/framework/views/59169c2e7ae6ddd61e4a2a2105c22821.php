
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<style>
   
    .carousel img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }


</style>

<?php $__env->startSection('content'); ?>

<?php 

	$bannerurl =  url('/').Storage::url('/').$venuedetail->bannerimage;

?>
<div class="col-lg-10 col-md-10">
  <!--page header section start-->
        <section class="page-header-section ptb-100 gradient-overly-right" 
        style="background: url('<?php echo e($bannerurl); ?>')no-repeat center center / cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 col-lg-6">
                        <div class="page-header-content text-white">
                            <h1 class="text-white mb-2"><?php echo e($venuedetail->venuename); ?></h1>
                            <p class="lead"><?php echo e($venuedetail->description); ?></p>
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
                        <li class="list-inline-item breadcrumb-item"><a href="#">Venue </a></li>
                        <li class="list-inline-item breadcrumb-item active"><?php echo e($venuedetail->venuename); ?></li>
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
                    <div class="col-lg-8 col-md-8">

                    	  <!-- Post-->
                        <article class="post">
                            <div class="post-preview">
                                <div class="carousel">
                                <img src="<?php echo e($bannerurl); ?>" alt="article" class="img-fluid" style="max-height:400px" />
                                <img src="<?php echo e($bannerurl); ?>" alt="article" class="img-fluid" style="max-height:400px" />
                            </div>

                            </div>
                            <div class="post-wrapper">
                                <div class="post-header">
                                    <h1 class="post-title"><?php echo e($venuedetail->venuename); ?></h1>

                                 <div class="d-inline-flex">
                                     <div class="p-2 justify-content-start"> 
                                        <div class="rating">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                            <span class="text-muted ms-2">(4.5)</span>
                                        </div> 
                                    </div> 
                                    <div class="p-2 justify-content-end"> 
                                       
                                            <a href="#" onclick="shareOnFacebook()">
                                                <i class="bi bi-facebook fs-5"></i>
                                            </a>
                                            <a href="#" onclick="shareOnTwitter()">
                                                <i class="bi bi-twitter fs-5"></i>
                                            </a>
                                            <a href="#" onclick="shareOnWhatsApp()">
                                                <i class="bi bi-whatsapp fs-5"></i>
                                            </a>
                                            <a href="#" onclick="shareOnLinkedIn()">
                                                <i class="bi bi-linkedin fs-5"></i>
                                            </a>
                                         
                                    </div>                                    
                                </div>
                                <div class="post-content">
                                    
                                        <p><?php echo e($venuedetail->description); ?></p><br> 

                                         



                                  
                                  <br>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6" >
                                        <div id="calendar-component" class="shadow-lg"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">


                                        <aside class="widget widget-categories shadow-lg p-2">
                                <div class="widget-title p-2 text-center">
                                    <h5>Features</h5>
                                </div>
                                <ul class="pl-2">
                                    <?PHP
                                    $venuedataarray = json_decode($venuedetail->venuedata, true); 
                                    $i=0;
                                     foreach($venuedatafield as $datafield):

                                        $value = $venuedatafielddetails->firstWhere('id',$venuedataarray[$i])->optionname ?? $venuedataarray[$i];
                                        
                                        echo '<li>'.$datafield->datafieldname.' - '.$value.' '.$datafield->datafieldnametype.'</li>';

                                      
                                      $i++;
                                    endforeach;

                                ?>
                                    
                                </ul>
                            </aside> 


                            </div>
                            </div>


                                <div class="post-footer">
                                    <div class="post-tags"><a href="#">Venue </a><a href="#">City</a><a href="#">State</a></div>



                                    <div class="row">

<div class="col-12">
    
                                         <div class="map-container">
<iframe 
width="100%" 
height="400" 
style="border:0;"
loading="lazy"
allowfullscreen        
src="<?php echo e($venuedetail->googlemap); ?>&output=embed">
</iframe>
</div>

</div>

    


<div class="col-12 pt-4">
      
<div class="comments-area">
    <h5 class="comments-title">Comments - </h5>
    <div class="comment-list">
        
    </div>

    
    <!-- Star Rating -->
    <div class="mb-3">
        <label class="form-label"><strong>Rate this Blog:</strong></label>
        <div class="star-rating">
            <i class="fa fa-star" data-value="1"></i>
            <i class="fa fa-star" data-value="2"></i>
            <i class="fa fa-star" data-value="3"></i>
            <i class="fa fa-star" data-value="4"></i>
            <i class="fa fa-star" data-value="5"></i>
        </div>
        <p class="mt-1">Your Rating: <span id="rating-value">0</span>/5</p>
    </div>

    <div class="comment-respond">
        <h5 class="comment-reply-title">Leave a Reply</h5>
        <p class="comment-notes"></p>
        <form class="comment-form row">          
            
            <div class="form-group col-md-12">
                <textarea class="form-control" rows="8" placeholder="Comment" name="Comments"></textarea>
            </div>
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
                        </article>
               </div> 
                  <div class="col-lg-4 col-md-4">
                        <div class="sidebar-right pl-4">
                        	 <aside class="widget widget-categories shadow-lg p-2">
                                <div class="widget-title p-2 text-center">
                                    <h5>Contact Details</h5>
                                </div>
                                <ul class="pl-2">
                                    <li>Contact Person - <?php echo e($venuedetail->contactperson); ?></li>
                                    <li>Contact Mobile - <?php echo e($venuedetail->contactmobile); ?></li>
                                    <li>Office Number - <?php echo e($venuedetail->contacttelephone); ?></li>
                                    <li>Email - <?php echo e($venuedetail->contactemail); ?></li>
                                    <li>Website - <?php echo e($venuedetail->websitename); ?></li>
                                    
                                </ul>
                            </aside>
                            <br>
                            <aside class="widget widget-categories shadow-lg p-2">
                                <div class="widget-title p-2 text-center">
                                    <h5>Amenities</h5>
                                </div>
                                <ul class="pl-2">
                                	<?PHP

                                    $amenitiesarray = json_decode($venuedetail->venueamenities, true); 
                                    

                                    foreach($venueamenities as $amenities):
                                        
                                        if(in_array($amenities->id, $amenitiesarray))
                                        {
                                            echo '<li>'.$amenities->amenities_name.'</li>';
                                        }
                                    endforeach;

                                ?>
                                    
                                </ul>
                            </aside>
                            <br>
                           
                            <div id="adsslider-component" style="height:350px"></div>        




                        </div>
                   </div>	

             </div>  
            
        </div> 
    </div>  
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>


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
    </script>
<?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
<?php echo app('Illuminate\Foundation\Vite')('resources/js/app.jsx'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/venuedetail.blade.php ENDPATH**/ ?>