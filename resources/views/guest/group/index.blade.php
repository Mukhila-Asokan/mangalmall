@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div id="group_container" class="content-section">
        @include('guest.group.group_list', $guestGroups)
    </div>
    <input type="hidden" name="group_id" id="group_id">
</div>
<div class="modal" id="edit_group_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title edit_group_title font-color"></h5>
                    <span class="font-12 edit_group_description"></span>
                </div>
                <div class="d-flex">
                    <button type="button" class="close ml-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container edit_group_content">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="add_group_contact_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="height: 18rem !important;">
            <div class="modal-header">
                <h5 class="modal-title font-14 font-color">Add Group Guest</h5>
                <div class="d-flex">
                    <button type="button" class="close ml-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container add_group_guest_section">
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-primary add_guest_group_btn font-14">Submit</button>
                <button type="button" class="btn btn-secondary font-14" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var groupId;
        $(document).on('click', '.edit_group, .view_group', function(){
            var id = $(this).data('id');
            var attrId = $(this).attr('id');
            $.ajax({
                url: '/guest/group/'+id+'/edit',
                type: 'GET',
                success: function(data){
                    $('#group_id').val(id);
                    $('.edit_group_title').text(data.guestGroup.group_name);
                    $('.edit_group_title').attr('id', attrId);
                    $('.edit_group_description').text(data.guestGroup.group_description ?? '-');
                    $('.edit_group_description').attr('id', attrId);
                    var guestGroupContact = '';
                    $.each(data.guestGroupContacts, function(index, value){
                        guestGroupContact += '<div class="row align-items-center">';
                        // Checkbox Column
                        if(attrId == 'edit_group'){
                            guestGroupContact += '<div class="col-md-2 d-flex align-items-right justify-content-center">';
                            guestGroupContact += '<div class="group_guest_select">';
                            guestGroupContact += '<input type="checkbox" class="font-14 form-control" data-id="'+value.id+'" id="guest_contact_list_'+ value.id +'" name="selected_guests[]" value="'+ value.id +'">';
                            guestGroupContact += '<label for="guest_contact_list_'+ value.id +'"></label>';
                            guestGroupContact += '</div>';
                            guestGroupContact += '</div>';
                        }
                        // Name Column
                        guestGroupContact += '<div class="col-md-5 d-flex">';
                        guestGroupContact += '<i class="bi bi-person-circle mt-1 font-14"></i>';
                        guestGroupContact += '<span class="form-control-plaintext font-14 d-block ml-1">' + value.name + '</span>';
                        guestGroupContact += '</div>';
                        // Mobile Number Column
                        guestGroupContact += '<div class="col-md-5 d-flex">';
                        guestGroupContact += '<i class="bi bi-telephone font-14 mt-1"></i>';
                        guestGroupContact += '<span class="form-control-plaintext font-14 d-block ml-1">' + value.mobile_number + '</span>';
                        guestGroupContact += '</div>';
                        guestGroupContact += '</div>';
                        guestGroupContact += '<hr>';
                    });
                    if(attrId == 'edit_group'){
                        guestGroupContact += '<div class="row align-items-center">';
                        guestGroupContact += '<button type="button" class="btn btn-primary btn-sm ml-auto" data-length="'+ data.guestGroupContacts.length +'" data-id="'+data.guestGroup.id+'" id="delete_group_contact">Delete</button>';
                        guestGroupContact += '</div>';
                    }
                    $('.edit_group_content').html(guestGroupContact);
                    $('#edit_group_modal').modal('show');
                }
            });
        })

        $(document).on('click', '.delete_group', function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('guest.group.delete') }}",
                type: "POST",
                data: {
                    'id' : id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    if(response.status == 'success'){
                        window.location.reload();
                    }
                }
            });
        })

        $(document).on('click', '#delete_group_contact', function(){
            let selectedValues = $('input[name="selected_guests[]"]:checked').map(function () {
                return $(this).attr('data-id');
            }).get();

            var id = $(this).data('id');
            var length = $(this).data('length');
    
            $.ajax({
                url: "{{ route('guest.update.group') }}",
                type: 'POST',
                data: {
                    selected_guests: selectedValues,
                    id: id,
                    length: length
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 'success'){
                        location.reload();
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.edit_group_title').click(function() {
                if($(this).attr('id') == 'edit_group'){
                    var $text = $(this),
                    $input = $('<input type="text" class="form-control" id="edit_group_title"/>')
                    $text.hide()
                    .after($input);
                    
                    $input.val($text.html()).show().focus()
                    .focusout(function() {
                        if($input.val() != $text.text()){
                            $.ajax({
                                url: "{{ route('guest.update.group.text') }}",
                                type: "POST",
                                data: {
                                    'name' : $('#edit_group_title').val(),
                                    'desc' : $('.edit_group_description').text(),
                                    'id' : $('#group_id').val()
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response){
                                    $text.html($input.val());
                                    $text.show();
                                    $input.hide();
                                }
                            })
                        }
                        else{
                            $text.show();
                            $input.hide();
                        }
                    })
                }
            });

            $('.edit_group_description').click(function() {
                if($(this).attr('id') == 'edit_group'){
                    var $text = $(this),
                    $input = $('<textarea class="form-control" id="edit_group_description"></textarea>')
                    $text.hide()
                    .after($input);
                    
                    $input.text($text.html()).show().focus()
                    .focusout(function() {
                        if($input.text() != $text.text()){
                            $.ajax({
                                url: "{{ route('guest.update.group.text') }}",
                                type: "POST",
                                data: {
                                    'name' : $('.edit_group_title').text(),
                                    'desc' : $('#edit_group_description').text(),
                                    'id' : $('#group_id').val()
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response){
                                    $text.text($input.text());
                                    $text.show();
                                    $input.hide();
                                }
                            })
                        }
                        else{
                            $text.show();
                            $input.hide();
                        }
                    })
                }
            });
        });

        $('.add_group_contact').on('click', function(){
            var id = $(this).data('id');
            groupId = id;
            $.ajax({
                url: "{{ route('guest.new-group') }}",
                type: "GET",
                data: {
                    'id' : id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    $('.add_group_guest_section').empty();
                    var newGroupContacts = '';
                    newGroupContacts += '<div class="row align-items-center">';
                    newGroupContacts += '<div class="col-12">';
                    newGroupContacts += '<label for="guest_select_option" class="font-14">Select Guests</label>';
                    newGroupContacts += '<select class="form-control guest-select2 font-14" id="guest_select_option" name="selected_contacts[]" multiple>';

                    $.each(response, function(index, value){
                        newGroupContacts += '<option value="'+ value.id +'">'+ value.name +'</option>';
                    });

                    newGroupContacts += '</select>';
                    newGroupContacts += '</div>';
                    newGroupContacts += '</div>';
                    $('.add_group_guest_section').append(newGroupContacts);

                    $('.guest-select2').select2({
                        placeholder: "",
                        allowClear: true,
                        width: '100%',
                        dropdownParent: $("#add_group_contact_modal")
                    });
                    $('#add_group_contact_modal').modal('show');
                }
            })
        })

        $('.add_guest_group_btn').on('click', function(){
            let selectedGuests = $('#guest_select_option').val();
            console.log(selectedGuests);
            $.ajax({
                url: "{{ route('add.guest.group') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'selectedGuests': selectedGuests,
                    'groupId': groupId
                },
                success: function(response){
                    if(response.status == 'success'){
                        window.location.reload();
                    }
                }
            })
        })

        $(document).on('click', '.clear_search', function(){
            window.location.reload();
        })

        //todo
        var countGroup = 30;
        $('.load_more_groups').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('guest.group') }}",
                type: "GET",
                data: {
                    "count": countGroup
                },
                success: function(response) {
                    if (response.status == 'success') {
                        let groupHtml = '';

                        response.data.forEach(group => {
                            console.log(group, 'contact')
                            groupHtml += `
                            <div class="col-3 mb-4">
                                <div class="card contact-card m-1">
                                    <div class="card-header m-2">
                                        <div class="row">
                                            <div class="col-8 text-start d-flex">
                                                <i class="bi bi-people-fill font-14"></i>
                                                <span class="font-14 font-weight-bold ml-1">${group.group_name}</span>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end align-items-center">
                                                <a id="add_group" data-id="${group.id}" class="add_group_contact pointer">
                                                    <i class="bi bi-person-plus-fill font-20"></i>
                                                </a>
                                                <a id="edit_group" class="edit_group ml-2 pointer" data-id="${group.id}">
                                                    <i class="bi bi-pencil-square font-20"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0 p-0">
                                    <div class="card-body p-2 mb-2">
                                        <div class="row mt-2">
                                            <div class="col-md-12 d-flex">
                                                <i class="bi bi-file-earmark-text font-12"></i>
                                                <span class="font-12 ml-1">${group.group_description.length > 30 ? group.group_description.substring(0, 30) + '...' : group.group_description || '-'}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="row d-flex">
                                            <div class="col-md-6 d-flex justify-content-start p-0">
                                                <a id="delete_group" class="delete_group ml-2 pointer" data-id="${group.id}">
                                                    <i class="bi bi-trash3"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-end p-0">
                                                <button class="btn btn-primary waves-effect waves-light text-end ml-1 pl-2 pr-2 pt-1 pb-1 font-12 view_group" id="view_group" data-id="${group.id}">
                                                    View Group
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        });

                        $('.contact-list').append(groupHtml);
                        countGroup += response.data.length;

                        if (response.data.length < 30) {
                            $('.load_more_contacts').hide();
                        }
                    }
                }
            });
        });
    </script>
@endpush