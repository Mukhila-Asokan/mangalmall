 @extends('layouts.guest')




@section('content')
<link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
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
  

 @include('layouts.slider')
 @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        @include('layouts.search')

@php
$url = "frontassets/img/hero-bg-4.jpg";

@endphp
 @include('layouts.vendorgallery')

 @include('layouts.promotion')

 @include('layouts.trustedvendor')

 @include('layouts.builder')

   @include('layouts.testimonial')

                  <!--call to action new style start-->
        <section class="call-to-action ptb-100" style="background: url('{{ asset($url) }}')no-repeat center center / cover fixed">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-8">
                        <div class="call-to-action-content text-white text-center">
                            <h2 class="">For Better use, Please download our apps</h2>
                            
                            <div class="action-btns mt-3">
                                <a href="#">
                                        <img src = '{{ asset("frontassets/img/googleplaystore.png"); }}' style ="width:100px" /></a>
                                <a href="#"><img src = '{{ asset("frontassets/img/appstore.png"); }}' style ="width:100px" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--call to action new style end-->
       
@endsection
 @php
    $areaContent = ''; 
  
    foreach ($arealocation as $key => $area) {
        $areaContent .= '{id: '.$area['id'].', title: "' . $area['Areaname'].' - '.$area['City'].'"},'; 
    }

    // Remove the trailing comma
    $areaContent = rtrim($areaContent, ','); 
   
   
@endphp








@push('scripts')

<script src="{{ asset('adminassets/libs/selectize/js/standalone/selectize.min.js') }}"></script>


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
            /*var venuetype = $('#venuetypeid').val();*/
         
          var venuearea = 1;
          var venusubtype = 1;

        $.ajax({
           type:'POST',
           url:"{{ route('home/venuesearchresults') }}",
           dataType: 'json',
           data:{ "_token": "{{ csrf_token() }}", "venuearea" :venuearea,"venuetype" :venuetype,"venusubtype" :venusubtype},
           success:function(response){ 
            $(".venuedetailslist").empty();
            console.log(response['venue'][0]);
             let content = ' <div class="row">';
            if(response['recordcount'] != 0)
            {    
               
                let venueLink = "";
                $(".search-section").css("display","block");  
					
                for(i=0;i<response['recordcount'];i++)
                {
                    venueLink = "<?php echo url('/home/'); ?>" +'/' +response['venue'][i]['id'] +'/venuedetails'; 
                    /*content += '<div class="col-md-4 col-lg-4 single-service-plane rounded white-bg shadow-sm p-5 mt-md-4 mt-lg-4 "><div class="features-box p-4"><div class="features-box-icon"><img src = "' + <?PHP echo "'".url('/').Storage::url('/')."'"; ?> + response['venue'][i]['bannerimage'] +'" style="width:200px" />  </div><div class="features-box-content">    <h5>'+response['venue'][i]['venuename']+'</h5>  <p>Location - '+response['venue'][i]['venueaddress']+'</p>  <p>'+response['venue'][i]['description']+'</p><p>Contact Person -  '+response['venue'][i]['contactperson']+' - '+response['venue'][i]['contactmobile'] +'</p><p>Contact Email Id - '+response['venue'][i]['contactemail']+'</p><div class="text-end"><a href = "'+venueLink+'">View Venue Details</a></div></div>  </div></div>';*/
					
					var onclickheart = "this.classList.toggle('bi-heart-fill'); this.classList.toggle('text-danger')";
					
					content += '<div class="col-md-3 mtb-1"><div class="card rounded white-bg shadow-sm p-1">                   		<div class="favorite-icon"> 			<i class="bi bi-heart" onclick="'+onclickheart+'"></i> 		</div> 		 	  		<div class="image-container"> 			<img src="' + <?PHP echo "'".url('/').Storage::url('/')."'"; ?> + response['venue'][i]['bannerimage'] +'" class="venue-img" alt="Venue Image"> 		</div> 		 		<div class="card-body"> 	 			<h5 class="card-title mb-2">'+response['venue'][i]['venuename']+'    </h5> <div class="label-container"> <span class="label-badge trusted single-service-plane">Trusted</span>   <span class="label-badge new single-service-plane">Premium</span></div><div class="rating mb-2"><i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-fill"></i> <i class="bi bi-star-half"></i> 				<span class="text-muted ms-2">(4.5)</span> </div> <div class="contact-info mb-2"><p class="card-text"><i class="bi bi-geo-alt-fill text-primary"></i> '+response['venue'][i]['venueaddress']+'</p></div><div class="contact-info mb-2"> 				<p class="card-text"><i class="bi bi-person-fill text-primary"></i> Contact: '+response['venue'][i]['contactperson']+'</p> 			</div> <div class="contact-info mb-3"> 				<p class="card-text"><i class="bi bi-telephone-fill text-primary"></i> <a href="tel:'+response['venue'][i]['contactmobile']+'" class="text-decoration-none">+91' +response['venue'][i]['contactmobile']+ '</a></p> 			</div> <hr><div class="share-icons d-flex justify-content-between align-items-center"> 				<div> 					<a href="#" onclick="shareOnFacebook()"> <i class="bi bi-facebook fs-5"></i></a> <a href="#" onclick="shareOnTwitter()"> 	<i class="bi bi-twitter fs-5"></i> </a> <a href="#" onclick="shareOnWhatsApp()"> 	<i class="bi bi-whatsapp fs-5"></i> </a> <a href="#" onclick="shareOnLinkedIn()"><i class="bi bi-linkedin fs-5"></i> </a> </div> <a href="'+venueLink+'" class="btn primary-solid-btn mr-2">View Details</a></div> </div> 	</div></div>';
					
					
                }
				
				content += '</div>';
               
            }
            else
            {
                content = "No records found </div>";
            }

           $(".venuedetailslist").append(content);
         }         
          
        });

      });


</script>
<script type="text/javascript">
  /*  
document.addEventListener("DOMContentLoaded", function () {
    const cursor = document.getElementById("custom-cursor");

    document.addEventListener("mousemove", (e) => {
        cursor.style.left = `${e.clientX}px`;
        cursor.style.top = `${e.clientY}px`;
    });

    // Add hover effect on links & buttons
    document.querySelectorAll("a, button").forEach((element) => {
        element.addEventListener("mouseenter", () => {
            cursor.classList.add("hover-effect");
        });

        element.addEventListener("mouseleave", () => {
            cursor.classList.remove("hover-effect");
        });
    });
});

*/
document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('state').addEventListener('change', function(e) {
            e.preventDefault();   
            var state = $(this).val();
            $.ajax({
            type:'POST',
            url:"{{ route('home/ajaxstate') }}",
            dataType: 'json',
            data:{ "_token": "{{ csrf_token() }}", "state" :state},
            success:function(response){  
                $("#city").empty();   
                var returnData = response;   
                if(returnData.length>0)
                {
                    let casestr = '<option>Select City</option>';
                    for(i=0;i<returnData.length;i++)
                    {
                        casestr  += '<option value = "' + returnData[i]['id'] + ' ">' + returnData[i]['cityname'] + '</option>';
                    }
                console.log(casestr);       
            
                $("#city").append(casestr);
                }
                else
                {
                    alert("No Data")
                }
            }        
            
            });
            
            });


        document.getElementById('chooselocation').addEventListener('click', function(e) {
            e.preventDefault();   
            var city = $('#city').val();
            var state = $('#state').val();
            $.ajax({
            type:'POST',
            url:"{{ route('home/chooselocation') }}",
            dataType: 'json',
            data:{ "_token": "{{ csrf_token() }}", "city" :city,"state" :state},
            success:function(response){  
                $("#citySearch").empty();
                $("#citySearch").autocomplete({
                minLength: 2, // Minimum characters before search starts
                select: function(event, ui) {
                $("#citySearch").val(ui.item.label); // Set the selected value
                console.log("Selected City:", ui.item.label);
                return false; // Prevent default behavior
        }
    });
                console.log(response);
                $('#onload').modal('hide');
            }        
            
            });
            
            }); 





            


        });



        $(document).ready(function() {
    $("#citySearch").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('home/ajaxcitysearch') }}", // Replace with your backend route
                type: "POST",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}", // CSRF Token for security
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
@endpush