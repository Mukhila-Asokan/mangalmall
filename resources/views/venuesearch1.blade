@extends('profile-layouts.profile')
<link href="{{ asset('adminassets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />

@section('content')
<div class="col-lg-8 col-md-8">
                        <!-- Search widget-->
    <aside class="widget widget-search">
      
            <input class="form-control" type="search" placeholder="Type Search Words">
            <button class="search-button" type="submit"><span class="ti-search"></span></button>
        
    </aside>

    <hr>  
   
    <div class="row white-bg shadow-sm p-2 mt-md-4 mt-lg-4">  
        

		<div class = "row pt-2 col-12">
			<div class="col-md-12 col-12">
			
			
			
			
			@livewire('venue-search') 

           


          
			</div>
		</div>
    </div>
</div>



@endsection


@push('scripts')

 
<script>
    Livewire.on('instanceUpdated', (instance) => {
		alertI("hai");
        console.log(instance);  // Log the instance data to the console
        document.getElementById('instance-name').innerText = instance.venuename; // Update DOM
    });
</script>

<script src="{{ asset('adminassets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script type="text/javascript">
    
  const searchUrl = "{{ route('home/venuesearchresults') }}";
const subtypeUrl = "{{ route('home/ajaxcvenuesubtypelist') }}";

$('#venuearea').selectize({
    valueField: 'id',
    labelField: 'title',
    searchField: 'title',
    options: [<?php echo $areaContent; ?>],
    create: false,
}).on('change', function () {
    @this.set('searchArea', $(this).val());
});


$('#venuetypeid').selectize({
    onChange: function(value) {
        @this.set('searchType', value);
    }
});


$.ajax({
    type: 'POST',
    url: subtypeUrl,
    dataType: 'json',
    data: { "_token": "{{ csrf_token() }}", "venuetypeid": venuetypeid },
    success: function(response) {  
        $("#venuesubtypeid").empty();
        if (response.length > 0) {
            let casestr = '<option value="">Select Venue Sub Type</option>';
            response.forEach(subtype => {
                casestr += `<option value="${subtype.id}">${subtype.venuetype_name}</option>`;
            });
            $("#venuesubtypeid").append(casestr);
            
            // Notify Livewire about the change
            @this.set('searchSubtype', $("#venuesubtypeid").val());
        } else {
            alert("No Data");
        }
    }
});

</script>
@endpush