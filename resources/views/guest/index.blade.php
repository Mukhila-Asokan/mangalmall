@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 container col-lg-10 col-md-10">
    <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
            <a class="font-14 nav-link active" href="#" data-target="all_contacts_container">All Contacts</a>
        </li>
        <li class="nav-item">
            <a class="font-14 nav-link" href="#" data-target="profile_container">Profile</a>
        </li>
        <li class="nav-item">
            <a class="font-14 nav-link" href="#" data-target="messages_container">Messages</a>
        </li>
    </ul>
    <hr>

    <div id="all_contacts_container" class="content-section">
        <div class="card p-3 m-3">
            <div class="d-flex justify-content-end mb-2">
                <button id="add_contact" class="font-14 btn btn-primary waves-effect waves-light text-end">
                    <span>+ Add Contact</span>
                </button>
            </div>
            <div class="row d-flex justify-content-start">
                @foreach($getGuestContacts as $contact)
                    <div class="card contact-card m-2 col-3">
                        <div class="card-header m-2">
                            <div class="row">
                                <div class="col-8 text-start d-flex">
                                    <i class="bi bi-person-circle"></i>
                                    <span class="font-14 font-weight-bold ml-1">{{$contact->name}}</span>
                                </div>
                                <div class="col-4 d-flex justify-content-end align-items-center">
                                    <a href="#" id="view_contact" class="view_contact" data-id="{{$contact->id}}"><i class="bi bi-eye"></i></a>
                                    <a href="#" id="edit_contact" class="edit_contact ml-2" data-id="{{$contact->id}}"><i class="bi bi-pencil-square"></i></a>
                                    <a href="#" id="view_contact" class="view_contact ml-2" data-id="{{$contact->id}}"><i class="bi bi-trash3"></i></a>
                                </div>
                            </div>
                        </div>
                        <hr class="m-0 p-0">
                        <div class="card-body p-1">
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
                                    <span class="font-12 ml-1">{{$contact->email}}</span>
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
                @endforeach
            </div>
        </div>
    </div>

    <div id="profile_container" class="content-section d-none">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile</h4>
            </div>
            <div class="card-body">
                <p>Profile details go here...</p>
            </div>
        </div>
    </div>

    <div id="messages_container" class="content-section d-none">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Messages</h4>
            </div>
            <div class="card-body">
                <p>Message list goes here...</p>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="add_contact_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Contact</h5>
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
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Contact Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="text" name="mobile_number" id="mobile_number" placeholder="Mobile Number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp_number">WhatsApp Number</label>
                                    <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="WhatsApp Number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" id="company" placeholder="Company" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <input type="text" name="designation" id="designation" placeholder="Designation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <textarea name="location" id="location" placeholder="Location" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" placeholder="Notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="edit_contact_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
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
                                    <label for="edit_company">Company</label>
                                    <input type="text" name="edit_company" id="edit_company" placeholder="Company" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_designation">Designation</label>
                                    <input type="text" name="edit_designation" id="edit_designation" placeholder="Designation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_location">Location</label>
                                    <textarea name="edit_location" id="edit_location" placeholder="Location" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_notes">Notes</label>
                                    <textarea name="edit_notes" id="edit_notes" placeholder="Notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        $('.nav-link').click(function(e) {
            e.preventDefault(); // Prevent default link behavior

            $('.nav-link').removeClass('active'); // Remove active class from all links
            $(this).addClass('active'); // Add active class to clicked link

            let target = $(this).data('target'); // Get target section

            $('.content-section').addClass('d-none'); // Hide all sections
            $('#' + target).removeClass('d-none'); // Show selected section
        });
    });

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
                    $('#edit_company').val(response.data.company);
                    $('#edit_designation').val(response.data.designation);
                    $('#edit_location').val(response.data.location);
                    $('#edit_notes').val(response.data.notes);
                }
                $('#edit_contact_modal').modal('show');
            }
        });
    })

    $('#add_contact').click(function() {
        $('#add_contact_modal').modal('show');
    });
</script>
@endpush