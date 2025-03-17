@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">
        @include('guest.guest_list', $getGuestContacts)
    </div>
</div>
<div class="col-lg-2 col-md-2">
</div>
<div class="modal" id="add_contact_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title font-20 font-color">Add Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_contact_form" method="POST" action="{{ route('guest.store') }}">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Contact Name" class="form-control font-14">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="mobile_number">Mobile Number</label>
                                    <input type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number" class="form-control font-14">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="whatsapp_number">WhatsApp Number</label>
                                    <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="WhatsApp Number" class="form-control font-14">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control font-14">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="relationship">Relation</label>
                                    <select name="relationship" id="relationship" class="form-control select2">
                                        <option value="" selected disabled>Select Relationship</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Uncle">Uncle</option>
                                        <option value="Aunt">Aunt</option>
                                        <option value="Nephew">Nephew</option>
                                        <option value="Niece">Niece</option>
                                        <option value="Grand Father">Grand Father</option>
                                        <option value="Grand Mother">Grand Mother</option>
                                        <option value="Cousin">Cousin</option>
                                        <option value="Friend">Friend</option>
                                        <option value="Colleague">Colleague</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="location">Location</label>
                                    <textarea name="location" id="location" placeholder="Location" class="form-control font-14"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="notes">Notes</label>
                                    <textarea name="notes" id="notes" placeholder="Notes" class="form-control font-14"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary font-14">Submit</button>
                        <button type="button" class="btn btn-secondary font-14" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="edit_contact_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_contact_form" method="POST" action="{{ route('guest.update') }}">
                    @csrf
                    <div class="container">
                        <input type="hidden" name="contact_id" id="contact_id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_name">Name</label>
                                    <input type="text" name="edit_name" id="edit_name" placeholder="Contact Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_mobile_number">Mobile Number</label>
                                    <input type="text" name="edit_mobile_number" id="edit_mobile_number" placeholder="Mobile Number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_whatsapp_number">WhatsApp Number</label>
                                    <input type="text" name="edit_whatsapp_number" id="edit_whatsapp_number" placeholder="WhatsApp Number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_email">Email</label>
                                    <input type="email" name="edit_email" id="edit_email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-14" for="edit_relationship">Relation</label>
                                    <select name="edit_relationship" id="edit_relationship" class="form-control select2">
                                        <option value="">Select Relationship</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Uncle">Uncle</option>
                                        <option value="Aunt">Aunt</option>
                                        <option value="Nephew">Nephew</option>
                                        <option value="Niece">Niece</option>
                                        <option value="Grand Father">Grand Father</option>
                                        <option value="Grand Mother">Grand Mother</option>
                                        <option value="Cousin">Cousin</option>
                                        <option value="Friend">Friend</option>
                                        <option value="Colleague">Colleague</option>
                                    </select>
                                </div>        
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_location">Location</label>
                                    <textarea name="edit_location" id="edit_location" placeholder="Location" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_notes">Notes</label>
                                    <textarea name="edit_notes" id="edit_notes" placeholder="Notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary font-14">Submit</button>
                        <button type="button" class="btn btn-secondary font-14" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="view_contact_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-14 font-weight-bold mb-0">Name</label>
                                <span id="view_name" class="form-control-plaintext font-12"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-14 font-weight-bold mb-0">Mobile Number</label>
                                <span id="view_mobile_number" class="form-control-plaintext font-12"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-14 font-weight-bold mb-0">WhatsApp Number</label>
                                <span id="view_whatsapp_number" class="form-control-plaintext font-12"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-14 font-weight-bold mb-0">Email</label>
                                <span id="view_email" class="form-control-plaintext font-12"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-14 font-weight-bold mb-0">Relationship</label>
                                <span id="view_relationship" class="form-control-plaintext font-12"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-14 font-weight-bold mb-0">Location</label>
                                <span id="view_location" class="form-control-plaintext font-12"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-14 font-weight-bold mb-0">Notes</label>
                                <span id="view_notes" class="form-control-plaintext font-12"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="create_group_modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title font-20 font-color">Create Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('guest.create.group') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <label for="guest_lists" class="font-14 mt-2">Guest List</label>
                            <select class="guest_list_multiple form-control w-100" multiple="multiple" name="guest_lists[]" id="guest_lists" required>
                                @foreach($guests as $guest)
                                    <option value="{{ $guest->id }}">{{ $guest->name }} - {{ $guest->mobile_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <label for="group_name" class="font-14 mt-2">Group Name</label>
                            <select class="select2 form-control w-100" name="group_name" id="group_name" required>
                                <option value="" selected disabeld>Select a group</option>
                                <option value="add new">Add New Group</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="group_details d-none card mt-3 p-3 row">
                            <h6 class="font-color">Add New Group</h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="font-14">Group Name</label>
                                        <input type="text" name="new_group_name" id="new_group_name" class="form-control font-14" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="font-14">Group Description</label>
                                        <textarea name="group_description" id="group_description" class="form-control font-14"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary create_group_btn font-14">Submit</button>
                        <button type="button" class="btn btn-secondary font-14" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="import_contact_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title font-20 font-color">Import Guest</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('upload.guest.contacts') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-1 d-flex justify-content-end">
                            <a href="{{ route('download.guest.format') }}" title="Download Guest Format" id="import_contact_download" class="font-14 btn btn-success waves-effect waves-light ml-1">
                                <span><i class="bi bi-arrow-down"></i> Download Format</span>
                            </a>
                        </div>
                        <div class="row">
                            <label class="font-14">Upload Guest File</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="upload_guest_details" name="upload_guest_details">
                                    <label class="custom-file-label font-14" for="upload_guest_details">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex w-100 justify-content-start">
                        <button type="submit" class="btn btn-primary upload_guest_excel font-14 ml-auto">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="assign_care_taker_model" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title font-20 font-color">Assign Caretaker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create.caretaker') }}" method="POST" id="caretaker_add_form">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="selected_guests" class="font-14">Select Guests</label>
                                    <select class="guest_list_caretaker form-control w-100" multiple="multiple" name="selected_guests[]" id="selected_guests" required>
                                        <option value="" disabled>Select Guest Name</option>
                                        @foreach($unAssignedGuests as $guest)
                                            <option value="{{ $guest->id }}">{{ $guest->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="caretaker_id" class="font-14">Caretaker</label>
                                    <select name="caretaker_id" class="form-control select2" id="caretaker_id" required>
                                        <option value="" disabled selected>Select Caretaker Name</option>
                                        <option value="add new">Add New Caretaker</option>
                                        @foreach($caretakers as $caretaker)
                                            <option value="{{ $caretaker->id }}"> {{ $caretaker->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card d-none" id="cartaker_details">
                            <div class="card-header">
                                <h6 class="p-2">Add Caretaker Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="caretaker_name" class="font-14">Name</label>
                                            <input type="text" class="form-control" required name="caretaker_name" id="caretaker_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="caretaker_email" class="font-14">Email</label>
                                            <input type="text" class="form-control" required name="caretaker_email" id="caretaker_email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="caretaker_mobile" class="font-14">Mobile Number</label>
                                            <input type="text" class="form-control" required name="caretaker_mobile" id="caretaker_mobile">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary create_caretaker font-14">Submit</button>
                        <button type="button" class="btn btn-secondary font-14" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('.edit_contact').on('click', function(){
        var id = $(this).data('id');
        $.ajax({
            url: '/guest/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                console.log(response.data.name);
                if(response.status == 'success'){
                    $('#contact_id').val(id);
                    $('#edit_name').val(response.data.name);
                    $('#edit_mobile_number').val(response.data.mobile_number);
                    $('#edit_whatsapp_number').val(response.data.whatsapp_number);
                    $('#edit_email').val(response.data.email);
                    $('#edit_relationship').val(response.data.relationship);
                    $('#edit_location').val(response.data.location);
                    $('#edit_notes').val(response.data.notes);
                }
                $('#edit_contact_modal').modal('show');
            }
        });
    })

    $('.view_contact').on('click', function(){
        var id = $(this).data('id');
        $.ajax({
            url: '/guest/' + id + '/edit',
            type: 'GET',
            success: function(response) {
                console.log(response.data.name);
                if(response.status == 'success'){
                    $('#view_name').text(response.data.name ?? '-');
                    $('#view_mobile_number').text(response.data.mobile_number ?? '-');
                    $('#view_whatsapp_number').text(response.data.whatsapp_number ?? '-');
                    $('#view_email').text(response.data.email ?? '-');
                    $('#view_relationship').text(response.data.relationship ?? '-');
                    $('#view_location').text(response.data.location ?? '-');
                    $('#view_notes').text(response.data.notes ?? '-');
                }
                $('#view_contact_modal').modal('show');
            }
        });
    })

    $('#delete_contact').on('click', function(){
        if(confirm('Are you sure want to delete this contact?')){
            var id = $(this).data('id');
            $.ajax({
                url: '/guest/' + id + '/delete',
                type: 'GET',
                success: function(response) {
                    if(response.status == 'success'){
                        location.reload();
                    }
                }
            });
        }
    });

    $(document).on('click', '#add_contact', function() {
        $('#add_contact_modal').modal('show');
    });

    var countContacts = 30;
    $('.load_more_contacts').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('guest.contacts') }}",
            type: "GET",
            data: {
                "count": countContacts
            },
            success: function(response) {debugger;
                if (response.status == 'success') {debugger;
                    let contactsHtml = '';

                    response.data.forEach(contact => {debugger;
                        console.log(contact, 'contact')
                        contactsHtml += `
                            <div class="round">
                                <input type="checkbox" name="contact_list[]" data-id="${contact.id}" id="contact_list_${contact.id}" />
                                <label for="contact_list_${contact.id}"></label>
                            </div>
                            <div class="card contact-card m-1">
                                <div class="card-header m-2">
                                    <div class="row">
                                        <div class="col-8 text-start d-flex">
                                            <i class="bi bi-person-circle"></i>
                                            <span class="font-14 font-weight-bold ml-1">${contact.name}</span>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end align-items-center">
                                            <a class="view_contact pointer" data-id="${contact.id}"><i class="bi bi-eye"></i></a>
                                            <a class="edit_contact ml-2 pointer" data-id="${contact.id}"><i class="bi bi-pencil-square"></i></a>
                                            <a class="delete_contact ml-2 pointer" data-id="${contact.id}"><i class="bi bi-trash3"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-0 p-0">
                                <div class="card-body p-1">
                                    <div class="row mt-2">
                                        <div class="col-md-12 d-flex">
                                            <i class="bi bi-telephone font-12"></i>
                                            <span class="font-12 ml-1">${contact.mobile_number}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 d-flex">
                                            <i class="bi bi-whatsapp font-12"></i>
                                            <span class="font-12 ml-1">${contact.whatsapp_number}</span>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 d-flex">
                                            <i class="bi bi-envelope font-12"></i>
                                            <span class="font-12 ml-1">${contact.email}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                    });

                    $('.contact-list').append(contactsHtml);
                    countContacts += response.data.length;

                    if (response.data.length < 30) {
                        $('.load_more_contacts').hide();
                    }
                }
            }
        });
    });

    // $(document).on('click', '#assign_caretaker', function(){
    //     let selectedValues = $('input[name="contact_list[]"]:checked').map(function () {
    //         return $(this).attr('data-id');
    //     }).get();
    //     if(selectedValues.length < 1){
    //         alert('Please select atleast one contact to assing caretaker');
    //         return false;
    //     }
    //     else{
    //         $('#caretaker_id').append('<option value="add new">Add New Caretaker</option>');
    //         $.each(<?=$caretakers?>, function(key, value){
    //             $('#caretaker_id').append(`<option value="${value.id}">${value.name}</option>`);
    //         })
    //         $('#selected_guests').val(JSON.stringify(selectedValues));
    //         $('#assign_care_taker_model').modal('show');

    //         $('#caretaker_id').on('change', function(){
    //             if($(this).val() == 'add new'){
    //                 $('#cartaker_details').removeClass('d-none');
    //             }
    //             else{
    //                 document.querySelectorAll('.d-none input[required]').forEach(input => {
    //                     input.removeAttribute('required');
    //                 });
    //                 $('#cartaker_details').addClass('d-none');
    //             }
    //         })
    //     }
    // })

    $("#caretaker_id").on('change', function(){
        if($(this).val() == 'add new'){
            $('#cartaker_details').removeClass('d-none');
        }
        else{
            document.querySelectorAll('.d-none input[required]').forEach(input => {
                input.removeAttribute('required');
            });
            $('#cartaker_details').addClass('d-none');
        }
    })

    $(document).on('click', '#assign_caretaker', function(){
        $('#assign_care_taker_model').modal('show');

        $('.guest_list_caretaker').select2({
            placeholder: 'Select options',
            closeOnSelect: false,
            templateResult: formatStateCaretaker,
            allowHtml: true,
            allowClear: true,
            tags: true,
            dropdownParent: $('#assign_care_taker_model')
        }).on('select2:open', function () {
            if (!$('.custom-search-box').length) {
                $('.select2-dropdown').prepend(
                    '<input type="text" class="custom-search-box w-100" placeholder="Search...">'
                );

                $('.custom-search-box').on('input', function () {
                    var searchText = $(this).val().toLowerCase();
                    $('.select2-results__option').each(function () {
                        if ($(this).text().toLowerCase().includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            }
        });

        $('#selected_guests').on('select2:select', function(e) {
            updateCheckboxState();
        });

        $('#selected_guests').on('select2:unselect', function(e) {
            updateCheckboxState();
        });

        function updateCheckboxState() {
            console.log($('.select2-results__option[aria-selected=true]'));
            var selectedOptions = $('.select2-results__option[aria-selected=true]');
            selectedOptions.each(function() {
                var $checkbox = $(this).find('.select2-checkbox');
                $checkbox.prop('checked', true);
            });

            var unselectedOptions = $('.select2-results__option[aria-selected=false]');
            unselectedOptions.each(function() {
                var $checkbox = $(this).find('.select2-checkbox');
                $checkbox.prop('checked', false);
            });
        }

        function formatStateCaretaker(state) {
            if (!state.id) {
                return state.text;
            }

            var $state = $(
                '<span><input type="checkbox" class="select2-checkbox" /> ' + state.text + '</span>'
            );

            $state.find('.select2-checkbox').prop('checked', state.selected);

            $state.find('.select2-checkbox').on('click', function() {
                state.selected = !state.selected;
                $(this).prop('checked', state.selected);
                $('#multiSelect').trigger('change');
            });

            return $state;
        }
    });

    $('#create_group').on('click', function(){
        $('#create_group_modal').modal('show');

        $('.guest_list_multiple').select2({
            placeholder: 'Select options',
            closeOnSelect: false,
            templateResult: formatState,
            allowHtml: true,
            allowClear: true,
            tags: true,
            dropdownParent: $('#create_group_modal')
        }).on('select2:open', function () {
            if (!$('.custom-search-box').length) {
                $('.select2-dropdown').prepend(
                    '<input type="text" class="custom-search-box w-100" placeholder="Search...">'
                );

                $('.custom-search-box').on('input', function () {
                    var searchText = $(this).val().toLowerCase();
                    $('.select2-results__option').each(function () {
                        if ($(this).text().toLowerCase().includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            }
        });

        $('#guest_lists').on('select2:select', function(e) {
            updateCheckboxState();
        });

        $('#guest_lists').on('select2:unselect', function(e) {
            updateCheckboxState();
        });

        function updateCheckboxState() {
            console.log($('.select2-results__option[aria-selected=true]'));
            var selectedOptions = $('.select2-results__option[aria-selected=true]');
            selectedOptions.each(function() {
                var $checkbox = $(this).find('.select2-checkbox');
                $checkbox.prop('checked', true);
            });

            var unselectedOptions = $('.select2-results__option[aria-selected=false]');
            unselectedOptions.each(function() {
                var $checkbox = $(this).find('.select2-checkbox');
                $checkbox.prop('checked', false);
            });
        }

        function formatState(state) {
            if (!state.id) {
                return state.text;
            }

            var $state = $(
                '<span><input type="checkbox" class="select2-checkbox" /> ' + state.text + '</span>'
            );

            $state.find('.select2-checkbox').prop('checked', state.selected);

            $state.find('.select2-checkbox').on('click', function() {
                state.selected = !state.selected;
                $(this).prop('checked', state.selected);
                $('#multiSelect').trigger('change');
            });

            return $state;
        }
    })

    $('#group_name').on('change', function(){
        if($(this).val() == 'add new'){
            $('.group_details').removeClass('d-none');
        }
        else{
            $('.group_details').addClass('d-none');
        }
    })
    
    $('#import_contact').on('click', function(){
        $('#import_contact_modal').modal('show');
    })

    document.getElementById("upload_guest_details").addEventListener("change", function() {
        let fileName = this.files[0] ? this.files[0].name : "Choose file";
        this.nextElementSibling.textContent = fileName;
    });

    $(document).on('click', '.clear_search', function(){
        window.location.reload();
    })

    $(document).on('click', '[data-dismiss="modal"]', function() {
        $('.modal').modal('hide');
    });
</script>
@endpush