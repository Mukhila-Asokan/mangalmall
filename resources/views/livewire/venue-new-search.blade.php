<div>
   <div>

  @if ($instance)  {{-- Correct variable name: $instance --}}
        {{ $instance->venuename }} <br/>
        {{ $instance->address }} <br/>
        {{ $instance->phone }} <br/>
        {{-- ... other properties --}}
    @else
        <p>No venue details available.</p>
    @endif

<div class="row pt-2 col-12">
    <div class="col-lg-3 col-md-3">
        <div class="form-group">
            <select wire:model="searchArea" id="venuearea" class="form-control has-value">
                <option value="">Select Area</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->Areaname }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-md-3">
        <div class="form-group">
            <select wire:model="searchType" id="venuetypeid" class="form-control has-value">            
                <option value="">Select Venue Type</option>
                @foreach($venuetypes as $type)
                    <option value="{{ $type->id }}">{{ $type->venuetype_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
  
  
    
  
      <div class="col-lg-3 col-md-3">
        <div class="form-group">
            <select wire:model="searchSubtype" id="venuesubtypeid" class="form-control has-value">
                <option value="">Select Venue Subtype</option>
                @foreach($subtypes as $subtype)
                    <option value="{{ $subtype->id }}">{{ $subtype->subtype_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
  
  
  


    <div class="col-lg-3 col-md-3">
        <div class="form-group">
            <select wire:model="sortBy" class="form-control has-value">
                <option value="">Sort By</option>
                <option value="price_asc">Price Low to High</option>
                <option value="price_desc">Price High to Low</option>
                <option value="featured">Featured</option>
                <option value="alphabetical_asc">Alphabets A - Z</option>
                <option value="alphabetical_desc">Alphabets Z - A</option>
            </select>
        </div>
    </div>
</div>

<br>

<!-- Amenities Filter -->
<div class="row pt-2 col-12">
    <div class="col-md-12 col-lg-12">
        <div id="accordion-one" class="accordion accordion-faq">
            <div class="card mb-0 px-4">
                <a class="card-header collapsed" data-toggle="collapse" href="#collapseTwo-one">
                    <h6 class="mb-0 d-inline-block">Filter</h6>
                </a>
                <div id="collapseTwo-one" class="collapse" data-parent="#accordion-one">
                    <div class="card-body">
                        <div class="row pt-2 col-12">
                            @foreach($venueamenities as $amenities)
                                <div class="form-check col-4 pt-2">
                                    <input type="checkbox" wire:model="selectedAmenities" class="form-check-input" value="{{ $amenities->id }}"/>
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                        {{ $amenities->amenities_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Venue List -->
<div class=" row grid grid-cols-1 gap-4 lg:grid-cols-3 md:grid-cols-2">
 @if(isset($venuelist) && $venuelist->count() > 0)
    @foreach($venuelist as $list)
    
    @php
        $baseImageUrl = rtrim(url('/'), '/') . Storage::url('/');
        $venueLink = url('/home/' . e($list->id) . '/venuedetails');

          $imageUrl = $baseImageUrl .$list->bannerimage;
    
    @endphp
        
        <div class="col-md-6 col-lg-6 single-service-plane rounded white-bg shadow-sm p-5 mt-md-4 mt-lg-4">
                <div class="features-box p-4">
                    <div class="features-box-icon">
                        <img src="{{ $imageUrl }}" style="width:200px" />
                    </div>
                    <div class="features-box-content">
                        <h5>{{ $list->venuename }}</h5>
                        <p>Location - {{ $list->venueaddress }} <br>
              Area - {{ $list->indianlocation->Areaname }} <br>
            {{ $list->indianlocation->City }}, {{ $list->indianlocation->District }}</p>
                        <p>{{ $list->description }}</p>
                        <p>Contact Person - {{ $list->contactperson }} - {{ $list->contactmobile }}</p>
                        <p>Contact Email Id - {{ $list->contactemail }}</p>
                        <div class="text-end">
                            <a href="{{ $venueLink }}">View Venue Details</a>
                        </div>
                    </div>
                </div>
            </div>
    
    @endforeach
    
     @else
            <div class="rounded-lg bg-white p-4 text-center shadow">No venues found.</div>
     @endif

   
</div>

</div>


</div>
