<div class="card p-3 m-3 border-0">
    <div class="card-header pb-1 pr-3">
        <div class="row">
            <div class="col-md-6 d-flex">
                <span class="font-20 font-color font-weight-bold"> All Guests</span>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button id="add_contact" class="font-14 btn btn-primary waves-effect waves-light">
                    <span>+ Add Guest</span>
                </button>
                <button id="import_contact" class="font-14 btn btn-primary waves-effect waves-light ml-1">
                    <span><i class="bi bi-arrow-up"></i> Import Guests</span>
                </button>
                <a href="{{ route('guest.group.index') }}" id="add_contact" class="font-14 btn btn-primary ml-1 waves-effect waves-light">
                    <span>View Groups</span>
                </a>
            </div>
        </div>
    </div>
    <hr>
    <div class="card-body">
        <div class="d-flex justify-content-between row mb-4">
            <div class="mb-2 col-7 d-flex">
                <div class="input-group">
                    <input type="text" id="search_guest_value" class="form-control" placeholder="Search Guest details here..." aria-label="Search Guest details here..." aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" id="search_guest_details" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <button class="btn btn-primary ml-2 font-14 clear_search" type="button">Clear</button>
            </div>
            <div class="mb-2 col-4 d-flex justify-content-end align-items-end">
                <button id="create_group" class="font-14 btn btn-primary waves-effect waves-light ml-1">
                    <span>Create Group</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row d-flex contact-list ml-1">
        @foreach($getGuestContacts as $contact)
        <div class="col-3 p-1">
            <div class="round">
                <input type="checkbox" name="contact_list[]" data-id="{{$contact->id}}" id="contact_list_{{$contact->id}}" />
                <label for="contact_list_{{$contact->id}}"></label>
            </div>
            <div class="card contact-card m-1">
                <div class="card-header m-2">
                    <div class="row">
                        <div class="col-8 text-start d-flex">
                            <i class="bi bi-person-circle"></i>
                            <span class="font-14 font-weight-bold ml-1">{{$contact->name}}</span>
                        </div>
                        <div class="col-4 d-flex justify-content-end align-items-center">
                            <a id="view_contact" class="view_contact pointer" data-id="{{$contact->id}}"><i class="bi bi-eye"></i></a>
                            <a id="edit_contact" class="edit_contact ml-2 pointer" data-id="{{$contact->id}}"><i class="bi bi-pencil-square"></i></a>
                            <a id="delete_contact" class="delete_contact ml-2 pointer" data-id="{{$contact->id}}"><i class="bi bi-trash3"></i></a>
                        </div>
                    </div>
                </div>
                <hr class="m-0 p-0">
                <div class="card-body p-2 mb-2">
                    <div class="row mt-2">
                        <div class="col-md-12 d-flex">
                            <i class="bi bi-telephone font-12"></i>
                            <span class="font-12 ml-1">{{$contact->mobile_number}}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 d-flex">
                            <i class="bi bi-whatsapp font-12"></i>
                            <span class="font-12 ml-1">{{$contact->whatsapp_number}}</span>
                        </div>
                        <!-- <div class="col-md-6 d-flex">
                            <i class="bi bi-buildings"></i>
                            <span class="font-14 ml-1">{{$contact->company}}</span>
                        </div> -->
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 d-flex">
                            <i class="bi bi-envelope font-12"></i>
                            <span class="font-12 ml-1">{{ Str::limit($contact->email, 30, '...') }}</span>
                        </div>
                    </div>
                    <!-- <div class="row mt-1">
                        <div class="col-12 d-flex">
                            <i class="bi bi-geo-alt"></i>
                            <span class="font-14 ml-1">{{$contact->location}}</span>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12 d-flex">
                            <i class="bi bi-journal-text"></i>
                            <span class="font-14 ml-1">{{$contact->notes}}</span>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(count($getGuestContacts) == 0)
        <div class="col-12 text-center">
            <div class="">No contacts found</div>
        </div>
    @endif
    @if(count($getGuestContacts) > 30)
        <div class="col-12 d-flex justify-content-center mt-4">
            <a href="" class="btn primary-solid-btn text-center load_more_contacts w-25">Load More</a>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        $(document).on('click', '#search_guest_details', function(){
            var value = $('#search_guest_value').val();
            $.ajax({
                url: "{{ route('guest.search') }}",
                type: "GET",
                data: {
                    "value": value
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 'success'){
                        $("#all_contacts_container").html(response.html);
                    }
                }
            })
        })
    </script>
@endpush