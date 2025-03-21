@extends('admin.layouts.app-admin')
@section('content')

<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-4">Add Event Budget</h4>
            
            <div class="text-end">
                <a href = "{{ route('admin.eventbudget.index') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end">
                                <span class="tf-icon mdi mdi-eye me-1"></span>Budget List
                </a>
            </div>
        <form class="form-horizontal" role="form" method = "post" action="{{ route('admin.eventbudget.store') }}">
            @csrf
            <div class="col-6">
      
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="occasion_id">Occasion</label>
                <div class="col-md-8">
                    <select id="occasion_id" name="occasion_id" class="form-control">
                        <option value="">Select Occasion</option>
                        @foreach($occasions as $occasion)
                            <option value="{{ $occasion->id }}" {{ old('occasion_id') == $occasion->id ? 'selected' : '' }}>{{ $occasion->eventtypename }}</option>
                        @endforeach
                    </select>
                    @error('occasion_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-md-4 col-form-label" for="category_id">Budget Category</label>
                <div class="col-md-8">
                    <select id="category_id" name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-4 row">
            <label class="col-md-4 col-form-label">Checklist Items</label>
            <div class="col-md-8">
                <ul id="checklist_items" class="list-group">
                    <!-- Checklist items will be loaded here -->
                </ul>
            </div>
        </div>

            <br><br>
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add Event Budget</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
   

        $('#category_id').on('change', function() {
            var categoryId = $(this).val();

            // Clear previous budget amount
            $('#budget_amount').val('');

            if (categoryId) {
                $.ajax({
                    url: "{{ route('admin.budgetitems.get') }}", // Create this route
                    type: 'GET',
                    data: { "_token": "{{ csrf_token() }}", category_id: categoryId },
                    success: function(response) {
                        if (response.success) {
                            if (response.items.length > 0) {
                                $.each(response.items, function(index, item) {
                                    $('#checklist_items').append(`<li class="list-group-item">${item.name}</li>`);
                                });
                            } else {
                                $('#checklist_items').append(`<li class="list-group-item">No Budget items found.</li>`);
                            }
                        } else {
                            $('#checklist_items').append(`<li class="list-group-item text-danger">Error loading items.</li>`);
                        }
                    },
                    error: function() {
                        $('#checklist_items').append(`<li class="list-group-item text-danger">Failed to fetch items.</li>`);
                    }
                });
            }
        });
    });
</script>

@endpush