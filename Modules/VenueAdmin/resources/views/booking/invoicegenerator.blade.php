@extends('venueadmin::layouts.admin-layout')

@section('content')
<div class="container">
    <div class="row">  <!-- start page title -->      
        <div class="col-12">
            <div class="bg-flower">
                <img src="assets/images/flowers/img-3.png">
            </div>

            <div class="bg-flower-2">
                <img src="assets/images/flowers/img-1.png">
            </div>

            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pageroot }}</a></li>                    
                        <li class="breadcrumb-item active">{{ $pagetitle }}</li>
                    </ol>
                </div>
                <h4 class="page-title">Invoice</h4>
            </div>
        </div>
    </div>
    <div class="row g-4">

        <div class="col-12 mx-auto">
        <div class="card">
        <div class="card-body p-4">
            <div class="mb-4">

                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <!--img src="assets/images/logo-dark.png" alt="dark logo" height="22"-->
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">Invoice</h4>
                    </div>
                </div>

                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-end mt-3">
                            <p><b>Hello, {{ $venuebooking->contact->person_name }}</b></p>
                        </div>
                    </div><!-- end col -->
                    <div class="col-sm-4 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; Jan 17, 2023</p>
                            <p class="fs-13"><strong>Order Status: </strong> <span class="badge bg-success float-end">Paid</span></p>
                            <p class="fs-13"><strong>Order ID: </strong> <span class="float-end">#123456</span></p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row mt-4">
                    <div class="col-4">
                        <h6>Billing Address</h6>
                        <address>
                        {{ $venuebooking->contact->person_name }}<br>
                        {{ $venuebooking->contact->contact_address }} <br>
                          
                            <abbr title="Phone">P:</abbr>{{ $venuebooking->contact->mobileno }}
                        </address>
                    </div> <!-- end col-->
                  

                    <div class="col-4">
                        <div class="text-sm-end">
                            <!--img src="assets/images/barcode.png" alt="barcode-image" class="img-fluid me-2" /-->
                        </div>
                    </div> <!-- end col-->
                </div>
                <!-- end row -->
<div class="mt-3">
    <!-- Header -->
    <div class="row border-top border-bottom bg-light-subtle border-light py-2">
        <div class="col">#</div>
        <div class="col">Item</div>
        <div class="col">Unit Cost</div>
        <div class="col text-end">Total</div>
        <div class="col text-end">Action</div>
    </div>

    <!-- Base Price Selection -->
    <div class="row py-2">
        <div class="col">1</div>
        <div class="col">
            <select name="venueprice" class="form-select" id="selectvenueprice">
                <option value="0">Select Price</option>
                <option value="{{ $venuebooking->venuepricing->base_price }}">Base Price</option>
                <option value="{{ $venuebooking->venuepricing->peak_rate }}">Peak Price</option>
                <option value="custom">Custom Price</option>
            </select>
        </div>
        <div class="col">
            <input type="text" name="venueprice" id="venue-price" class="form-control" value="0">
        </div>
        <div class="col"></div>
    </div>

    <!-- Existing Addons -->
    @php $total = 0; @endphp
    
        @foreach($venuebooking->venuepricing->addons as $index => $addon)
            @php $total += $addon->addonprice; 
              $priceid = $addon->id.',';
            $bookingpriceaddon = Modules\VenueAdmin\Models\VenuePriceAddons::where('id', $addon->id)->first();
            
            @endphp

         <div class="row py-2 addon-item">
                <div class="col">{{ $index + 2 }}</div>
                <div class="col">
                    <input type="hidden" name="addonid[]" value="{{ $addon->id }}" />
                    <input type="text" name="addonidval[]" class="form-control" value="{{ $bookingpriceaddon->addonname  }}" />
                </div>
                <div class="col">
                    <input type="text" name="addonprice[]" class="form-control addon-price" value="{{ $addon->addonprice }}" />
                </div>
                <div class="col text-end">
                <button type="button" class="btn btn-danger btn-sm remove-addon">Remove</button>
            </div>
            </div>
        @endforeach


    <!-- New Addons -->
    <div id="extra-addons"></div>

    <!-- Add More Button -->
    <div class="row py-2">
        <div class="col"></div>
        <div class="col">
            <button type="button" class="btn btn-secondary" id="add-addon">Add More</button>
        </div>
        <div class="col"></div>
        <div class="col text-end"></div>
    </div>

    <!-- Total Cost -->
    <div class="row py-2 border-top">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"><h4><b>Total Cost:</b></h4></div>
        <div class="col text-end">
           <h4> <b id="total-cost"><i class="bi bi-currency-rupee me-3 fs-20"></i> {{ number_format($total, 2) }}</b></h4>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Add/Remove Addons & Update Total -->
<script>
function calculateTotal() {
    let total = 0;

    // Add venue price
    let venuePrice = parseFloat(document.getElementById('venue-price').value) || 0;
    total += venuePrice;

    // Add all addon prices
    document.querySelectorAll('.addon-price').forEach(input => {
        let price = parseFloat(input.value) || 0;
        total += price;
    });

    // Update total cost display
    document.getElementById('total-cost').innerText = '<i class="bi bi-currency-rupee me-3 fs-20"></i> ' + total.toFixed(2);
}

document.addEventListener('DOMContentLoaded', function() {

    // Handle Venue Price Selection
    document.getElementById('selectvenueprice').addEventListener('change', function() {
        let selectedPrice = this.value;
        let venuePriceInput = document.getElementById('venue-price');
        if (selectedPrice === "custom") {
            venuePriceInput.value = "";
            venuePriceInput.focus();
        } else {
            venuePriceInput.value = selectedPrice;
        }
        calculateTotal();
    });

    // Update total when prices change
    document.getElementById('venue-price').addEventListener('input', calculateTotal);
    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('addon-price')) {
            calculateTotal();
        }
    });

    document.getElementById('add-addon').addEventListener('click', function() {
        var extraAddons = document.getElementById('extra-addons');
        var index = extraAddons.children.length + document.querySelectorAll('.addon-item').length + 2;

        var newAddon = document.createElement('div');
        newAddon.classList.add('row', 'py-2', 'addon-item');
        newAddon.innerHTML = `
            <div class="col">` + index + `</div>
            <div class="col">
                <select name="addon_name[]" class="form-select addon-name">
                    <option value="">Select Addon</option>
                    @php
                        $excludedIds = explode(',', $priceid);
                        $availableAddons = Modules\VenueAdmin\Models\VenuePriceAddons::whereNotIn('id', $excludedIds)->get();
                    @endphp
                    @foreach($availableAddons as $addon)
                        <option value="{{ $addon->id }}" data-price="{{ $addon->price }}">{{ $addon->addonname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="text" name="addon_price[]" class="form-control addon-price" placeholder="Price" />
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-danger btn-sm remove-addon">Remove</button>
            </div>
        `;
        extraAddons.appendChild(newAddon);
        calculateTotal();
    });

    // Remove Addon
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-addon')) {
            event.target.closest('.addon-item').remove();
            calculateTotal();
        }
    });
});

document.addEventListener('change', function(event) {
  
    if (event.target.classList.contains('addon-name')) {
        let selectedOption = event.target.options[event.target.selectedIndex];
        let price = selectedOption.getAttribute('data-price') || 0;
        let priceInput = event.target.closest('.row').querySelector('.addon-price');       
        if (priceInput) {
            priceInput.value = price;
        }
        calculateTotal();
    }
});
</script>

                        </div> <!-- end table-responsive-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="clearfix pt-3">
                            <h6 class="text-muted">Cancellation Policy:</h6>
                            <small>
                            {{ $venuebooking->venuepricing->cancellation_policy }}
                            </small>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>Sub-total:</b> <span class="float-end"><i class="fa fa-inr" aria-hidden="true"></i>  </span></p>
                            <p><b>GST :</b> <span class="float-end"><i class="fa fa-inr" aria-hidden="true"></i> </span></p>
                            <h3> </h3>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row-->

                <div class="d-print-none mt-4">
                    <div class="text-end">
                        <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line"></i> Print</a>
                        <a href="javascript: void(0);" class="btn btn-info">Submit</a>
                    </div>
                </div>
                <!-- end buttons -->
            </div>
            </div> <!-- end card -->
        </div>
        </div> <!-- end col-->
    </div>
</div>

@endsection
@push('scripts')

<script>

    document.getElementById('selectvenueprice').addEventListener('change', function() {
        var selectedPrice = this.value;      
        var venuePriceInput = document.querySelector('input[name="venueprice"]');
        
        if (selectedPrice === 'custom') {
            venuePriceInput.value = '';
            venuePriceInput.removeAttribute('readonly');
        } else {
            venuePriceInput.value = selectedPrice;
            venuePriceInput.setAttribute('readonly', 'readonly');
        }
    });
</script>

@endpush
