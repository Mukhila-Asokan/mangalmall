@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    @include('guest.caretaker.caretaker_list')
</div>
<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>
<div class="modal" id="add_guest_caretaker_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="homemodal-content" style="height: 18rem !important;">
            <div class="modal-header">
                <h5 class="modal-title font-14 font-color">Add Caretaker Guest</h5>
                <div class="d-flex">
                    <button type="button" class="close ml-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="{{route('create.caretaker.more')}}" id="caretaker_form" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container add_caretaker_guest_section">
                    </div>
                
                </div>
                <div class="modal-footer p-2">
                    <button type="submit" class="btn btn-primary font-14">Submit</button>
                    <button type="button" class="btn btn-secondary font-14" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="edit_caretaker_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="homemodal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title edit_caretaker_title font-color"></h5>
                </div>
                <div class="d-flex">
                    <button type="button" class="close ml-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container edit_caretaker_content">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
        $(document).on('click', '#search_caretaker', function(){
            var value = $('#search_caretaker_value').val();
            $.ajax({
                url: "{{ route('caretaker.search') }}",
                type: "GET",
                data: {
                    "value": value
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 'success'){
                        $("#group_container").html(response.html);
                    }
                }
            })
        })

        $(document).on('click', '#add_caretaker_guest', function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('list.guest.caretaker') }}",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 'success'){
                        $('.add_caretaker_guest_section').empty();
                        var newGroupContacts = '';
                        newGroupContacts += `<input type="hidden" value='${id}' name="caretaker_id" id="caretaker_id">`;
                        newGroupContacts += '<div class="row align-items-center">';
                        newGroupContacts += '<div class="col-12">';
                        newGroupContacts += '<label for="guest_select_option" class="font-14">Select Guests</label>';
                        newGroupContacts += '<select class="form-control guest-select2 font-14" id="guest_select_option" name="selected_contacts[]" multiple>';

                        $.each(response.guestList, function(index, value){
                            newGroupContacts += '<option value="'+ value.id +'">'+ value.name +'</option>';
                        });

                        newGroupContacts += '</select>';
                        newGroupContacts += '</div>';
                        newGroupContacts += '</div>';
                        $('.add_caretaker_guest_section').append(newGroupContacts);

                        $('.guest-select2').select2({
                            placeholder: "",
                            allowClear: true,
                            width: '100%',
                            dropdownParent: $("#add_guest_caretaker_modal")
                        });
                        $('#add_guest_caretaker_modal').modal('show');
                    }
                }
            });
        })

        $(document).on('click', '.edit_caretaker_guest, .view_caretaker_details', function(){
            var id = $(this).data('id');
            var attrId = $(this).attr('id');
            $.ajax({
                url: '/edit/caretaker/'+id,
                type: 'GET',
                success: function(data){
                    $('#group_id').val(id);
                    $('.edit_caretaker_title').text(data.caretaker.name);
                    $('.edit_caretaker_title').attr('id', attrId);
                    var guestCaretakerContact = '';
                    $.each(data.guestCaretakers, function(index, value){
                        guestCaretakerContact += '<div class="row align-items-center">';
                        if(attrId == 'edit_caretaker_guest'){
                            guestCaretakerContact += '<div class="col-md-2 d-flex align-items-right justify-content-center">';
                            guestCaretakerContact += '<div class="group_guest_select">';
                            guestCaretakerContact += '<input type="checkbox" class="font-14 form-control" data-id="'+value.contact.id+'" id="guest_contact_list_'+ value.contact.id +'" name="selected_guests[]" value="'+ value.contact.id +'">';
                            guestCaretakerContact += '<label for="guest_contact_list_'+ value.contact.id +'"></label>';
                            guestCaretakerContact += '</div>';
                            guestCaretakerContact += '</div>';
                        }

                        guestCaretakerContact += '<div class="col-md-5 d-flex">';
                        guestCaretakerContact += '<i class="bi bi-person-circle mt-1 font-14"></i>';
                        guestCaretakerContact += '<span class="form-control-plaintext font-14 d-block ml-2">' + value.contact.name + '</span>';
                        guestCaretakerContact += '</div>';

                        guestCaretakerContact += '<div class="col-md-5 d-flex">';
                        guestCaretakerContact += '<i class="bi bi-telephone font-14 mt-1"></i>';
                        guestCaretakerContact += '<span class="form-control-plaintext font-14 d-block ml-2">' + value.contact.mobile_number + '</span>';
                        guestCaretakerContact += '</div>';
                        guestCaretakerContact += '</div>';
                        guestCaretakerContact += '<hr>';
                    });
                    if(attrId == 'edit_caretaker_guest'){
                        guestCaretakerContact += '<div class="row align-items-center">';
                        guestCaretakerContact += '<button type="button" class="btn btn-primary btn-sm ml-auto" data-length="'+ data.guestCaretakers.length +'" data-id="'+data.caretaker.id+'" id="delete_group_contact">Delete</button>';
                        guestCaretakerContact += '</div>';
                    }
                    $('.edit_caretaker_content').html(guestCaretakerContact);
                    $('#edit_caretaker_modal').modal('show');
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
                url: "{{ route('caretaker.update') }}",
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

        $(document).on('click', '#delete_caretaker', function(){
            if(confirm('Are you sure want to delete this caretaker?')){
                $.ajax({
                    url: "{{ route('caretaker.delete') }}",
                    type: "POST",
                    data: {
                        id: $(this).data('id')
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(){
                        window.location.reload();
                    }
                })
            }
        })

        var countGroup = 30;
        $(document).on('click', '.load_more_caretakers', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('list.caretaker.ajax') }}",
                type: "GET",
                data: {
                    "count": countGroup
                },
                success: function(response) {
                    if (response.status == 'success') {
                        let groupHtml = '';

                        console.log(response);
                        response.caretakers.forEach(caretaker => {
                            groupHtml += `
                            <div class="col-3 mb-4">
                                <div class="card contact-card m-1">
                                    <div class="card-header m-2">
                                        <div class="row">
                                            <div class="col-8 text-start d-flex">
                                                <i class="bi bi-people-fill font-14"></i>
                                                <span class="font-14 font-weight-bold ml-1">${caretaker.name}</span>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end align-items-center">
                                                <a id="add_caretaker_guest" data-id="${caretaker.id}" class="add_caretaker_guest pointer">
                                                    <i class="bi bi-person-plus-fill font-20"></i>
                                                </a>
                                                <a id="edit_caretaker_guest" class="edit_caretaker_guest ml-2 pointer" data-id="${caretaker.id}">
                                                    <i class="bi bi-pencil-square font-20"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0 p-0">
                                    <div class="card-body p-2 mb-2">
                                        <div class="row mt-2">
                                            <div class="col-md-12 d-flex">
                                                <i class="bi bi-telephone font-12"></i>
                                                <span class="font-12 ml-1">${caretaker.mobile_number}</span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12 d-flex">
                                                <i class="bi bi-envelope font-12"></i>
                                                <span class="font-12 ml-1">${caretaker.email}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <div class="row d-flex">
                                            <div class="col-md-6 d-flex justify-content-start p-0">
                                                <a id="delete_caretaker" class="delete_caretaker ml-2 pointer" data-id="${caretaker.id}">
                                                    <i class="bi bi-trash3"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-end p-0">
                                                <button class="btn btn-primary waves-effect waves-light text-end ml-1 pl-2 pr-2 pt-1 pb-1 font-12 view_caretaker_details" id="view_caretaker_details" data-id="${caretaker.id}">
                                                    View Guests
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        });

                        $('.contact-list').append(groupHtml);
                        countGroup += response.data.length;

                        if (response.data.length < 3) {
                            $('.load_more_contacts').hide();
                        }
                    }
                }
            });
        })

        $(document).on('click', '[data-dismiss="modal"]', function() {
            $('.modal').modal('hide');
        });
    </script>
@endpush