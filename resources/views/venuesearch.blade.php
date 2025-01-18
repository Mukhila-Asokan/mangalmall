@extends('profile-layouts.profile')
<link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
@section('content')
  <!--page header section start-->
        <section class="page-header-section ptb-100" style="background: url('{{ asset("frontassets/img/herobg-5.png"); }}')no-repeat center center / cover;background-attachment: fixed;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-7 col-lg-6">
                        <div class="page-header-content text-white">
                            <h1 class="text-white mb-2">Profile Dashboard</h1>
                            <p class="lead"></p>
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
                                <li class="list-inline-item breadcrumb-item active"><a href="#">Profile</a></li>
                                
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb bar end-->


<div class="module ptb-50">
    <div class="container">
       <div class="row">
            <div class="col-lg-2 col-md-2">
                @include('profile-layouts.sidebar')
            </div>
<div class="col-lg-10 col-md-10">
                        <!-- Search widget-->
    <aside class="widget widget-search">
        <form>
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        </form>
    </aside>

    <hr>  
   
    <div class="row white-bg shadow-sm p-5 mt-md-4 mt-lg-4">  
        
       <form class="submit-request-form">
        <div class="row pt-2">
            <div class="col-12">
                 <div class="form-group">
                    <select id="venuearea" name="venuearea"  placeholder="Enter the Area name" class="form-control has-value"></select>
                </div>

                <div class="form-group">                                                            
                    <select id="venuetypeid" class="form-control has-value">
                        <option value="">Select Venue Type</option>      
                        @foreach($venuetypes as $type)
                            <option value = "{{ $type->id }}">{{ $type->venuetype_name }}</option>
                        @endforeach                             
                    </select>
                </div>
                <div class="form-group">                                                            
                    <select id="venuesubtypeid" class="form-control has-value">
                        <option value="">Select Venue subtype</option>                          
                    </select>
                </div>
            </div>
            
            <div class="col-md-6 col-12">
                <div class="action-btns mt-4">
                    <button href="#" class="btn primary-solid-btn mr-2" id="searchbutton" type = "button" >Search</button>
                </div>
            </div>
        </div>
        
    </form>
    </div>
</div>
</div>
</div>
</div>

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
                    venueLink = "<?php echo url('/home/'); ?>" +'/' +response['venue'][i]['id'] +'/venuedetails'; 
                    content += '<div class="col-md-12 col-lg-12 single-service-plane rounded white-bg shadow-sm p-5 mt-md-4 mt-lg-4 "><div class="features-box p-4"><div class="features-box-icon"><img src = "' + <?PHP echo "'".url('/').Storage::url('/')."'"; ?> + response['venue'][i]['bannerimage'] +'" style="width:200px" />  </div><div class="features-box-content">    <h5>'+response['venue'][i]['venuename']+'</h5>  <p>Location - '+response['venue'][i]['venueaddress']+'</p>  <p>'+response['venue'][i]['description']+'</p><p>Contact Person -  '+response['venue'][i]['contactperson']+' - '+response['venue'][i]['contactmobile'] +'</p><p>Contact Email Id - '+response['venue'][i]['contactemail']+'</p><div class="text-end"><a href = "'+venueLink+'">View Venue Details</a></div></div>  </div></div>';
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