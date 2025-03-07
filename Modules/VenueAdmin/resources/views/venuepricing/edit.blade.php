@extends('venueadmin::layouts.admin-layout')
@section('content')

<form class="form-horizontal" role="form" method="post" action="{{ route('venuepricing.update', $venuePricing->id) }}">
    @csrf
    @method('PUT')
    <div class="col-12">
        <div class="card">
            <div class="row mt-4">
                <div class="text-end me-2">   
                    <a href="{{ route('venue.pricing') }}" class="me-4 btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-eye"></i> View
                    </a>
                </div>
                <h3 class="text-center">Edit Pricing for Venue </h3>
            </div>

            <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <div class="mb-4 mt-4 row">
                    <label class="col-md-2 col-form-label" for="venue_id">Venue Name</label>
                    <div class="col-md-6">
                        <select id="venue_id" name="venue_id" class="form-control border border-warning" required>
                            <option value="">Select Venue</option>
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}" {{ $venuePricing->venue_id == $venue->id ? 'selected' : '' }}>{{ $venue->venuename }}</option>
                            @endforeach
                        </select>
                        @error('venue_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="base_price">Base Price</label>
                    <div class="col-md-6">
                        <input type="text" id="base_price" name="base_price" class="form-control border border-warning" placeholder="Enter the base price" value="{{ old('base_price', $venuePricing->base_price) }}" required>
                        @error('base_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="pricing_type">Pricing Type</label>
                    <div class="col-md-6">
                        <select id="pricing_type" name="pricing_type" class="form-control border border-warning" required>
                            <option value="">Select Pricing Type</option>
                            <option value="Hourly" {{ $venuePricing->pricing_type == 'Hourly' ? 'selected' : '' }}>Hourly</option>
                            <option value="Day" {{ $venuePricing->pricing_type == 'Day' ? 'selected' : '' }}>Day</option>
                            <option value="Weekend" {{ $venuePricing->pricing_type == 'Weekend' ? 'selected' : '' }}>Weekend</option>
                            <option value="Custom" {{ $venuePricing->pricing_type == 'Custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                        @error('pricing_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="peak_rate">Peak Rate</label>
                    <div class="col-md-6">
                        <input type="text" id="peak_rate" name="peak_rate" class="form-control border border-warning" placeholder="Enter the peak rate" value="{{ old('peak_rate', $venuePricing->peak_rate) }}" required>
                        @error('peak_rate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="deposit_amount">Deposit Amount</label>
                    <div class="col-md-6">
                        <input type="text" id="deposit_amount" name="deposit_amount" class="form-control border border-warning" placeholder="Enter the deposit amount" value="{{ old('deposit_amount', $venuePricing->deposit_amount) }}" required>
                        @error('deposit_amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="cancellation_policy">Cancellation Policy</label>
                    <div class="col-md-6">
                        <textarea id="cancellation_policy" name="cancellation_policy" class="form-control border border-warning" placeholder="Enter the cancellation policy" required>{{ old('cancellation_policy', $venuePricing->cancellation_policy) }}</textarea>
                        @error('cancellation_policy')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Addon Selection -->
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="addon_id">Addon</label>
                    <div class="col-md-6">
                        <select id="addon_id" class="form-control border border-warning">
                            <option value="">Select Addon</option>
                            @foreach($addons as $addon)
                                <option value="{{ $addon->id }}" data-price="{{ $addon->price }}">{{ $addon->addonname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Addon Price Display -->
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="addon_price">Addon Price</label>
                    <div class="col-md-6">
                        <input type="text" id="addon_price" class="form-control border border-warning" placeholder="Addon price will be displayed here" readonly>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="mb-4 row">
                    <div class="col-md-6 offset-md-2">
                        <button type="button" id="addAddonBtn" class="btn btn-success">Add</button>
                    </div>
                </div>

                <!-- List of Selected Addons -->
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label">Selected Addons</label>
                    <div class="col-md-6">
                        <ul id="addonList" class="list-group">
                            @foreach($venuePricing->addons as $addon)
                                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $addon->id }}">
                                    {{ $addon->addonname }} - ₹{{ $addon->pivot->price }}
                                    <button type="button" class="btn btn-danger btn-sm remove-addon">Delete</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div id="addonInputs">
                    @foreach($venuePricing->addons as $addon)
                        <input type="hidden" name="addon_id[]" value="{{ $addon->id }}">
                        <input type="hidden" name="addon_price[]" value="{{ $addon->pivot->price }}">
                    @endforeach
                </div>

                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('addon_id').addEventListener('change', function() {
        var selectedAddon = this.options[this.selectedIndex];
        var addonPrice = selectedAddon.getAttribute('data-price');
        document.getElementById('addon_price').value = addonPrice;
    });

    document.getElementById('venue_id').addEventListener('change', function() {
        var venueId = this.value;
        if (venueId) {
            fetch(`/venueadmin/venuepricing/getRate/${venueId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('base_price').value = data.bookingprice;                    
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

@endsection

@push('scripts')

<script>
$(document).ready(function () {
    // Update addon price when dropdown selection changes
    $('#addon_id').change(function () {
        let selectedOption = $(this).find(':selected');
        let price = selectedOption.data('price') || ''; 
        $('#addon_price').val(price);
    });

    // Add selected addon to list
    $('#addAddonBtn').click(function () {
        let selectedOption = $('#addon_id').find(':selected');
        let addonId = selectedOption.val();
        let addonName = selectedOption.text();
        let addonPrice = selectedOption.data('price');

        if (addonId && addonPrice) {
            // Check if addon already exists
            if ($('#addonList').find(`[data-id="${addonId}"]`).length === 0) {
                let listItem = `
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${addonId}">
                        ${addonName} - ₹${addonPrice}
                        <button type="button" class="btn btn-danger btn-sm remove-addon">Delete</button>
                    </li>
                `;
                $('#addonList').append(listItem);

                // Add hidden input fields to the form
                $('#addonInputs').append(`
                    <input type="hidden" name="addon_id[]" value="${addonId}">
                    <input type="hidden" name="addon_price[]" value="${addonPrice}">
                `);
            } else {
                alert('Addon already added!');
            }
        } else {
            alert('Please select a valid addon.');
        }
    });

    // Remove addon from list and hidden inputs
    $(document).on('click', '.remove-addon', function () {
        let addonId = $(this).closest('li').data('id');

        // Remove the list item
        $(this).closest('li').remove();

        // Remove hidden inputs
        $(`#addonInputs input[value="${addonId}"]`).remove();
    });
});
</script>
@endpush