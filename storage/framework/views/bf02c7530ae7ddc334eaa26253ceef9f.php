 




<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('adminassets/libs/selectize/css/selectize.bootstrap3.css')); ?>" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">

 <style>
    .single-service-plane
    {
        border-top-right-radius: 100px!important;
        border-bottom-left-radius: 100px!important;
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
 </style>
  

 <?php echo $__env->make('layouts.slider', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
 <?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
        <?php echo $__env->make('layouts.search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php
$url = "frontassets/img/hero-bg-4.jpg";

?>
 <?php echo $__env->make('layouts.vendorgallery', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <?php echo $__env->make('layouts.promotion', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <?php echo $__env->make('layouts.trustedvendor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <?php echo $__env->make('layouts.blog', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

 <?php echo $__env->make('layouts.builder', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

   <?php echo $__env->make('layouts.testimonial', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                  <!--call to action new style start-->
        <section class="call-to-action ptb-100" style="background: url('<?php echo e(asset($url)); ?>')no-repeat center center / cover fixed">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="call-to-action-content text-white text-center">
                            <h2 class="">For Better use, Please download our apps</h2>
                            
                            <div class="action-btns mt-3">
                                <a href="#">
                                        <img src = '<?php echo e(asset("frontassets/img/googleplaystore.png")); ?>' style ="width:100px" /></a>
                                <a href="#"><img src = '<?php echo e(asset("frontassets/img/appstore.png")); ?>' style ="width:100px" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--call to action new style end-->
       
<?php $__env->stopSection(); ?>
 <?php
    $areaContent = ''; 
  
    foreach ($arealocation as $key => $area) {
        $areaContent .= '{id: '.$area['id'].', title: "' . $area['Areaname'].' - '.$area['City'].'"},'; 
    }

    // Remove the trailing comma
    $areaContent = rtrim($areaContent, ','); 
   
   
?>








<?php $__env->startPush('scripts'); ?>

<script src="<?php echo e(asset('adminassets/libs/selectize/js/standalone/selectize.min.js')); ?>"></script>


<script type="text/javascript">
    
  

    $('#venuearea').selectize({
 
  valueField: 'id',
  labelField: 'title',
  searchField: 'title',
  options: [<?PHP echo $areaContent; ?>  ],
  create: false
});




      $("#searchbutton").click(function(e) {
         e.preventDefault();   

            var venuearea = $('#venuearea').val();
            var venuetype = $('#venuetypeid').val();         
        

        $.ajax({
           type:'POST',
           url:"<?php echo e(route('home/venuesearchresults')); ?>",
           dataType: 'json',
           data:{ "_token": "<?php echo e(csrf_token()); ?>", "venuearea" :venuearea,"venuetype" :venuetype},
           success:function(response){ 
            console.log("Full Response:", response); // Debug the full response
            console.log("Venues Array:", response.venue); // Check if the array exists

    if (!response.venue || response.venue.length === 0) {
        console.log("No records found");
        $(".venuedetailslist").html("<div class='alert alert-warning'>No venues found.</div>");
        return;
    }

    $(".venuedetailslist").empty();
    let content = '';
    
    $(".search-section").css("display", "block");

    let venueLink = "<?php echo e(route('login')); ?>";

    response.venue.forEach((venue, i) => {
      /*  let venueLink = `<?php echo e(url('/home/')); ?>/${venue.id}/venuedetails`;*/ 

        let onclickheart = "this.classList.toggle('bi-heart-fill'); this.classList.toggle('text-danger')";
        let truncatedAddress = venue.venueaddress.length > 40 ? venue.venueaddress.slice(0, 40) + "..." : venue.venueaddress;
        content += `
            <div class="col-md-3 mtb-1">
                <div class="card rounded white-bg shadow-sm p-1">
                    
                    <div class="image-container">
                        <img src="<?php echo e(url('/')); ?>/storage/${venue.bannerimage}" class="venue-img" alt="Venue Image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2">${venue.venuename}</h5>
                      
                        <div class="rating mb-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span class="text-muted ms-2">(4.5)</span>
                        </div>
                        <div class="contact-info mb-2">
                            <p class="card-text"><i class="bi bi-geo-alt-fill text-primary"></i> ${truncatedAddress}</p>
                        </div>
                        <div class="contact-info mb-2">
                            <p class="card-text"><i class="bi bi-person-fill text-primary"></i> ${venue.contactperson}</p>
                        </div>
                        
                        <hr>
                        <div class="share-icons d-flex justify-content-between align-items-center">
                            <div>
                                <a href="#" onclick="shareOnFacebook()"><i class="bi bi-facebook fs-5"></i></a>
                                <a href="#" onclick="shareOnTwitter()"><i class="bi bi-twitter fs-5"></i></a>
                                <a href="#" onclick="shareOnWhatsApp()"><i class="bi bi-whatsapp fs-5"></i></a>
                                <a href="#" onclick="shareOnLinkedIn()"><i class="bi bi-linkedin fs-5"></i></a>
                            </div>
                            <a href="${venueLink}" class="btn primary-solid-btn mr-2">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    /*<div class="contact-info mb-3">
        <p class="card-text">
            <i class="bi bi-telephone-fill text-primary"></i> 
            <a href="tel:${venue.contactmobile}" class="text-decoration-none">+91 ${venue.contactmobile}</a>
        </p>
    </div>*/

    content += '';
    $(".venuedetailslist").append(content);
         }         
          
        });

      });


</script>
<script type="text/javascript">

$(document).ready(function() {
    $("#citySearch").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?php echo e(route('home/ajaxcitysearch')); ?>", // Replace with your backend route
                type: "POST",
                dataType: "json",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>", // CSRF Token for security
                    "query": request.term // User input
                },
                success: function(data) {
                    response(data); // Send the data to autocomplete
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching autocomplete data:", error);
                }
            });
        },
        minLength: 2, // Minimum characters before search starts
        select: function(event, ui) {
            $("#citySearch").val(ui.item.label); // Set the selected value
            console.log("Selected City:", ui.item.label);
            return false; // Prevent default behavior
        }
    });
});


</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\resources\views/layouts/home.blade.php ENDPATH**/ ?>