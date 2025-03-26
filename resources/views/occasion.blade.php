@extends('profile-layouts.profile')
@push('styles')
.card {
background-color: ##faf0dc;
border: 1px solid #f8f9fa;
border-radius: 5px;
padding: 10px;
margin-bottom: 10px;
}
@endpush
@section('content')
    <div class="col-lg-10 col-md-10">
        <!-- Search widget-->
         <div class="row">
            @include('profile-layouts.sticky')
            <div class="col-lg-11 col-md-11">
                <div class="row mt-3 pl-5">
                    <div class="col-md-6">
                        <h4 class="font-color">My Events</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <a id="addoccasion" data-target="#addoccasionpopup" data-toggle="modal" class="font-14 btn btn-primary waves-effect waves-light">
                                <span>+ Add Event</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="row pl-5 mt-2">
                    <div class="col-md-6 row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Event Name" aria-label="Event Name" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <a class="btn btn-outline-secondary"><i class="bi bi-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end">
                            <a id="addoccasion" data-target="#addoccasionpopup" data-toggle="modal" class="font-14 btn btn-primary waves-effect waves-light">
                                <span>+ Add Event</span>
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-lg-12 col-md-11 stickymenucontent shadow-sm">
                        <div class="row pl-5 pr-5 mt-2 mt-md-4 mt-lg-4">
                            <div class="col-12">
                                <div class="row">
                                    @if(count($useroccasion) > 0)
                                        @foreach($useroccasion as $occasion)
                                            <div class="col-md-4 mb-4 p-2">
                                                <a href="{{ route('view.event.page', ['id' => $occasion->id]) }}">
                                                    <div class="card contact-card shadow-lg border-0 rounded-3">
                                                        <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h5 class="card-title text-primary mb-0 h5">{{ $occasion->occasion_name }}</h5>
                                                            <!-- <div>
                                                                <a href="#" class="btn btn-warning btn-sm" id="editoccasion" onclick="editoccasion({{ $occasion->id }})" title="Edit">
                                                                <i class="ti-pencil"></i>
                                                                </a>
                                                                <a href="#" class="btn btn-danger btn-sm" title="Delete">
                                                                <i class="ti-trash"></i>
                                                                </a>
                                                            </div> -->
                                                        </div>
                                                        <div class="d-flex row">
                                                            <div class="col-md-6">
                                                                <p class="card-text mt-2 text-muted mb-0 font-14">Event - {{ $occasion->Occasionname->eventtypename }}</p>
                                                            </div>
                                                            <div class="col-md-6 d-flex justify-content-end">
                                                                @if(($occasion->occasionCollaborate)->pluck('user_id')->contains(auth()->user()->id))
                                                                    <div class="d-flex"><i class="bi bi-person-fill-check mt-1"></i> <p class="card-text mt-2 text-muted mb-0 font-14 text-end ml-1"> You </p></div>
                                                                @else
                                                                    <?php 
                                                                        $user = ($occasion->occasionCollaborate)->first();
                                                                    ?>
                                                                    <div class="d-flex"><i class="fa-solid fa-handshake-simple mt-1"></i><p class="card-text mt-2 text-muted mb-0 font-14 text-end ml-1">{{ $user->user->name }}</p></div>
                                                                @endif
                                                            </div>    
                                                        </div>

                                                        <hr class="my-3">
                                                        <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($occasion->occasiondate)->format('d/m/y') }}</p>
                                                        <p class="card-text"><strong>Place:</strong> {{ $occasion->occasion_place }}</p>
                                                        <p class="card-text overflow-hidden"><strong>Notes:</strong> {{ $occasion->notes }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <span>No Events Found</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-2">
        @include('profile-layouts.rightside')
    </div>
    <div class="modal fade" id="addoccasionpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="homemodal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method = "post" action = "{{ route('home/occasion/add')}}">
                    <div class="modal-body">
                    @csrf
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="occasiondate" class="font-14">Event Date </label>
                                <input type="Date" class="form-control" name="occasiondate" id="occasiondate" placeholder="Select Date" required="required">
                            </div>
                            <input type = "hidden" name = "userid" value = "{{ $userid }}" />
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="event_name" class="font-14">Event Name </label>
                                <input type="text" id="event_name" placeholder="Event Name" name="event_name" class="form-control">                
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="occasiontype" class="font-14">Event Type </label>
                                <select class="form-control" name="occasiontype" id="occasiontype" required="required">
                                <option>Select Event</option>
                                    @foreach($occasiontype as $typename)
                                        <option value="{{ $typename->id }}" >{{ $typename->eventtypename }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="countryInput" class="font-14">Event Type </label>
                                <input type="text" id="countryInput" placeholder="Event Place" name="occasion_place" class="form-control">                
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="message" class="font-14">Notes </label>
                                <textarea name="message" id="message" class="form-control" rows="5" cols="25" placeholder="Notes"></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn secondary-outline-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn primary-solid-btn" id ="savebutton">Add</button>
                    <button type="button" class="btn primary-solid-btn" id ="updateoccasion" style="display:none">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @php
        $str = '[';
        foreach($areaname as $aname):
            $str .= '"'.$aname->Areaname.'",' ; 
        endforeach;
        $str = rtrim($str, ','); 
        $str .= ']';
    @endphp
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css"></script>
<script>
   const countries =  <?PHP echo $str; ?>
   ;
   
   function autocomplete(inp, arr) {
       let currentFocus;
       
       inp.addEventListener("input", function(e) {
           let value = this.value.toLowerCase();
           let autocompleteList = document.querySelector('.autocomplete-items') || 
                                  createAutocompleteContainer(inp);
           
           // Clear previous matches
           autocompleteList.innerHTML = '';
           
           // Find matching countries
           let matches = arr.filter(country => 
               country.toLowerCase().includes(value)
           );
   
           // Create suggestion items
           matches.forEach(country => {
               let div = document.createElement("div");
               div.innerHTML = country;
               
               div.addEventListener("click", function() {
                   inp.value = this.innerHTML;
                   autocompleteList.innerHTML = '';
               });
               
               autocompleteList.appendChild(div);
           });
       });
   
       // Close suggestions when clicking outside
       document.addEventListener("click", function(e) {
           if (e.target !== inp) {
               let autocompleteList = document.querySelector('.autocomplete-items');
               if (autocompleteList) autocompleteList.innerHTML = '';
           }
       });
   
       function createAutocompleteContainer(inputElement) {
           let container = document.createElement('div');
           container.classList.add('autocomplete-items');
           inputElement.parentNode.appendChild(container);
           return container;
       }
   }
   
   // Initialize autocomplete
   autocomplete(document.getElementById("countryInput"), countries);
</script>
<script>
   function editoccasion(id)
   {
         $.ajax({
             url: '/home/occasion/edit',
             method: 'POST',
             data: {  _token:$('meta[name="_token"]').attr('content'), id:id },		
             success: function(response) {
                console.log(response);
               
             }
         });
   }
</script>
@endpush