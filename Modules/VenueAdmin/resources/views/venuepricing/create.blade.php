@extends('venueadmin::layouts.admin-layout')
@section('content')

<form class="form-horizontal" role="form" method="post" action="{{ route('venuepricing.add') }}">
    @csrf
    <div class="col-12">
        <div class="card">
            <div class="row mt-4">
                <div class="text-end me-2">   
                    <a href="{{ route('venue.pricing') }}" class="me-4 btn btn-primary waves-effect waves-light mb-4 text-end">
                        <i class="bi bi-eye"></i> View
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="venue_id">Venue Name</label>
                    <div class="col-md-6">
                        <select id="venue_id" name="venue_id" class="form-control border border-warning" required>
                            <option value="">Select Venue</option>
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                            @endforeach
                        </select>
                        @error('venue_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="pricing_type">Pricing Type</label>
                    <div class="col-md-6">
                        <select id="pricing_type" name="pricing_type" class="form-control border border-warning" required>
                            <option value="Hourly">Hourly</option>
                            <option value="Day">Day</option>
                            <option value="Weekday">Weekday</option>
                            <option value="Custom">Custom</option>
                        </select>
                        @error('pricing_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="base_price">Base Price</label>
                    <div class="col-md-6">
                        <input type="text" id="base_price" name="base_price" class="form-control border border-warning" placeholder="Enter the base price" value="{{ old('base_price') }}" required>
                        @error('base_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="peak_rate">Peak Rate</label>
                    <div class="col-md-6">
                        <input type="text" id="peak_rate" name="peak_rate" class="form-control border border-warning" placeholder="Enter the peak rate" value="{{ old('peak_rate') }}" required>
                        @error('peak_rate')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="deposit_amount">Deposit Amount</label>
                    <div class="col-md-6">
                        <input type="text" id="deposit_amount" name="deposit_amount" class="form-control border border-warning" placeholder="Enter the deposit amount" value="{{ old('deposit_amount') }}" required>
                        @error('deposit_amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="cancellation_policy">Cancellation Policy</label>
                    <div class="col-md-6">
                        <textarea id="cancellation_policy" name="cancellation_policy" class="form-control border border-warning" placeholder="Enter the cancellation policy" required>{{ old('cancellation_policy') }}</textarea>
                        @error('cancellation_policy')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="addon_id">Addon</label>
                    <div class="col-md-6">
                        <select id="addon_id" name="addon_id" class="form-control border border-warning" required>
                            <option value="">Select Addon</option>
                            @foreach($addons as $addon)
                                <option value="{{ $addon->id }}" data-price="{{ $addon->price }}">{{ $addon->name }}</option>
                            @endforeach
                        </select>
                        @error('addon_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row">
                    <label class="col-md-2 col-form-label" for="addon_price">Addon Price</label>
                    <div class="col-md-6">
                        <input type="text" id="addon_price" name="addon_price" class="form-control border border-warning" placeholder="Addon price will be displayed here" readonly>
                    </div>
                </div>

                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
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
</script>

@endsection