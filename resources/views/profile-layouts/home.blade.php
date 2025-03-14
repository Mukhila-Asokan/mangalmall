 @extends('layouts.guest')


<link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

<script type="text/javascript">

</script>
@section('content')

 <style>
    .single-service-plane
    {
        border-top-right-radius: 100px!important;
        border-bottom-left-radius: 100px!important;
        box-shadow: 3px 3px 6px #b8b9be, -3px -3px 6px #fff!important;
    }
 </style>
  

 @include('layouts.slider')
        @include('layouts.search')
 

    @include('layouts.testimonial')
                  <!--call to action new style start-->
        <section class="call-to-action ptb-100" style="background: url('{{ asset("frontassets/img/hero-bg-4.jpg"); }}')no-repeat center center / cover fixed">
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



<div class="modal fade" id="onload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Add this line to your code -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Do You Want Cookie? We Want Yours! 🍪</h5>
            </div>
            <div class="modal-body">
                This site uses cookies to personalies the content for you.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> <!-- And the relavant closing div tag -->








@push('scripts')

<script src="{{ asset('adminassets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script type="text/javascript">
    alert('This is the onload event');
    window.onload = () => {
        alert('This is the onload event');
        $('#onload').modal('show');
    }
</script>
<script type="text/javascript">
    
  

    $('#venuearea').selectize({
 
  valueField: 'id',
  labelField: 'title',
  searchField: 'title',
  options: [<?PHP echo $areaContent; ?>  ],
  create: false
});



      $("#venuetypeid").change(function(e) {


      
        e.preventDefault();   
        var venuetypeid = $(this).val();

        $.ajax({
           type:'POST',
           url:"{{ route('home/ajaxcvenuesubtypelist') }}",
           dataType: 'json',
           data:{ "_token": "{{ csrf_token() }}", "venuetypeid" :venuetypeid},
           success:function(response){  
            $("#venuesubtypeid").empty();   
            var returnData = response;   
            if(returnData.length>0)
            {
                let casestr = '<option>Select Venue Sub Type</option>';
                for(i=0;i<returnData.length;i++)
                {
                    casestr  += '<option value = "' + returnData[i]['id'] + ' ">' + returnData[i]['venuetype_name'] + '</option>';
                }
             console.log(casestr);       
           
             $("#venuesubtypeid").append(casestr);
            }
            else
            {
                alert("No Data")
            }
         }        
          
        });
           
     });



      $("#searchbutton").click(function(e) {
         e.preventDefault();   

            var venuearea = $('#venuearea').val();
            var venuetype = $('#venuetypeid').val();
            var venusubtype = $('#venuesubtypeid').val();
          

        $.ajax({
           type:'POST',
           url:"{{ route('home/venuesearchresults') }}",
           dataType: 'json',
           data:{ "_token": "{{ csrf_token() }}", "venuearea" :venuearea,"venuetype" :venuetype,"venusubtype" :venusubtype},
           success:function(response){ 
            $(".venuedetailslist").empty();
            console.log(response['venue'][0]);
             let content = "";
            if(response['recordcount'] != 0)
            {    
               
                let venueLink = "";
                $(".search-section").css("display","block");                
                for(i=0;i<response['recordcount'];i++)
                {
                   /* venueLink = "<?php echo url('/home/'); ?>" +'/' +response['venue'][i]['id'] +'/venuedetails'; */
                     venueLink = "{{ url('/home/') }}/";
                    content += '<div class="col-md-12 col-lg-12 single-service-plane rounded white-bg shadow-sm p-5 mt-md-4 mt-lg-4 "><div class="features-box p-4"><div class="features-box-icon"><img src = "' + <?PHP echo "'".url('/').Storage::url('/')."'"; ?> + response['venue'][i]['bannerimage'] +'" style="width:200px" />  </div><div class="features-box-content">    <h5>'+response['venue'][i]['venuename']+'</h5>  <p>Location - '+response['venue'][i]['venueaddress']+'</p> <div class="text-end"><a href = "'+venueLink+'">View Venue Details</a></div></div>  </div></div>';
                }
               
            }
            else
            {
                content = "No records found";
            }

           $(".venuedetailslist").append(content);
         }         
          
        });

      });


</script>
@endpush