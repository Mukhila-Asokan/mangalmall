<?php use App\Models\UserChecklist; ?>

@extends('profile-layouts.profile')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
.sortable-list {
    min-height: 200px; /* Ensures containers have enough space for drag and drop */
    background-color: #f1f1f1;
    border: 2px dashed #ddd;
    padding: 10px;
}

.checklist-item {
    cursor: move;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.ui-state-highlight {
    background-color:rgb(228, 204, 134);  /* Highlight placeholder when dragging */
    height: 50px;
    border: 2px dashed #666;
}

.checklist-item {
        transition: transform 0.2s ease, background-color 0.2s ease;
    }

    .checklist-item:hover {
        transform: translateY(-2px);
        background-color: #e9ecef;
    }

    .edit-icon, .delete-icon {
        font-size: 1.2rem;
        transition: color 0.2s ease;
    }

    .edit-icon:hover {
        color: #FFD700; /* Blue for edit */
    }

    .delete-icon:hover {
        color: #dc3545; /* Red for delete */
    }

    .card-header {
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .sortable-list li {
        border-left: 4px solid #FFD700; /* Blue indicator for visual emphasis */
    }
    .rightcorner
    {
        top: 0;
        right: 0;
    }

    </style>
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.sticky')
        <div class="col-lg-11 col-md-11 stickymenucontent">  
        <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mt-5 mb-5 text-center"> {{ $useroccasion->Occasionname->eventtypename  }} Checklist</h4>     
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addChecklistModal">
            Add New
        </a>

    </div>

    <div class="row">
    <!-- Checklist Columns -->
    @foreach(['not_started', 'doing', 'completed'] as $status)
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-{{ $status == 'not_started' ? 'danger' : ($status == 'doing' ? 'warning' : 'success') }} text-white">
                    <h5 class="mb-0 p-2 text-center">{{ ucfirst(str_replace('_', ' ', $status)) }}</h5>
                </div>
                <div class="card-body droppable" id="{{ $status }}">
                    <ul class="sortable-list">
                        @foreach($checklist[$status] ?? [] as $item)
                        <li class="checklist-item card p-3 mb-2 d-flex align-items-start shadow-lg position-relative"
                            data-id="{{ $item->id }}"
                            style="background-color: #f8f9fa; border-left: 4px solid rgb(253, 209, 13);">

                            <!-- Checklist Name (Left Side) -->
                            <div class="p-2 w-100 bd-highlight">
                                <strong class="me-auto text-secondary">{{ $item->name }}</strong>
                            </div>

                            <!-- Action Icons (Top-Right Corner) -->
                            <div class="position-absolute rightcorner p-2">
                                <i class="fas fa-edit text-primary mx-1 fa-2xs edit-icon"
                                data-bs-toggle="modal"
                                data-bs-target="#editChecklistModal"
                                data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                style="cursor: pointer;"></i>

                                <i class="fas fa-trash-alt text-danger fa-2xs delete-icon"
                                data-id="{{ $item->id }}"
                                style="cursor: pointer;"></i>
                            </div>
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>





</div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>


<!-- Edit Checklist Modal -->
<div class="modal fade" id="editChecklistModal" tabindex="-1" aria-labelledby="editChecklistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="homemodal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title">Edit Checklist Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
            </div>

            <div class="modal-body">
                <form id="editChecklistForm">
                    @csrf
                    <input type="hidden" name="id" id="edit-checklist-id">

                    <div class="mb-3">
                        <label for="edit-checklist-name" class="form-label">Checklist Item Name</label>
                        <input type="text" class="form-control" id="edit-checklist-name" name="name" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Checklist Modal -->
<div class="modal fade" id="addChecklistModal" aria-labelledby="addChecklistModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="homemodal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addChecklistModalLabel">Add New Checklist Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>

            <div class="modal-body">
                <form action="{{ route('checklist.store') }}" method="POST">
                    @csrf
                    
                    <!-- Checklist Item Name -->
                    <div class="mb-3">
                        <label for="item_name" class="form-label">Checklist Item Name</label>
                        <input type="text" class="form-control" id="item_name" name="item_name" required>
                    </div>

                    <!-- Hidden Occasion ID -->
                    <input type="hidden" name="occasion_id" value="{{ $useroccasion->id ?? '' }}">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Item</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<!-- jQuery UI (Load this after jQuery) -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>/*
    function confirmStatusChange(itemId, status) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to mark this item as '${status}' status ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'No, cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with AJAX request
            $.ajax({
                url: "{{ route('checklist.updateStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: itemId,
                    status: status
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Updated!',
                        text: 'Checklist status updated successfully.',
                        icon: 'success'
                    }).then(() => location.reload());  // Refresh to reflect changes
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        icon: 'error'
                    });
                }
            });
        } else {
            // If user cancels, uncheck the checkbox
            $(`#checkbox_${itemId}`).prop('checked', false);
        }
    });
}
*/

// Initialize Dragula.js
$(document).ready(function () {
    $(".sortable-list").sortable({
        connectWith: ".sortable-list",
        placeholder: "ui-state-highlight",
        stop: function (event, ui) {
            const itemId = ui.item.data('id');  // Extract item ID
            const newStatus = ui.item.closest('.droppable').attr('id');  // New status from target container
            
            console.log(`Item ID: ${itemId}`);
            console.log(`New Status: ${newStatus}`);

            // AJAX request for updating checklist status
            $.ajax({
                url: "{{ route('checklist.updateStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: itemId,
                    status: newStatus
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Updated!',
                        text: `Checklist item moved to '${newStatus}' successfully.`,
                        icon: 'success'
                    });
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update checklist status.',
                        icon: 'error'
                    });
                }
            });
        }
    }).disableSelection();
});





document.addEventListener('DOMContentLoaded', function () {
    // ========================== Edit Checklist ==========================
    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            const checklistId = this.getAttribute('data-id');
            const checklistName = this.getAttribute('data-name');

            document.getElementById('edit-checklist-id').value = checklistId;
            document.getElementById('edit-checklist-name').value = checklistName;
        });
    });

    // AJAX for Editing Checklist Item
    document.getElementById('editChecklistForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const checklistId = document.getElementById('edit-checklist-id').value;
        const checklistName = document.getElementById('edit-checklist-name').value;

        fetch(`{{ route('checklist.update','') }}/${checklistId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                name: checklistName
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the checklist name directly
                document.querySelector(`[data-id="${checklistId}"] strong`).innerText = checklistName;

                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'Checklist item has been updated.',
                    timer: 2000
                });

                const modal = bootstrap.Modal.getInstance(document.getElementById('editChecklistModal'));
                modal.hide();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to update the checklist item.',
                });
            }
        })
        .catch(error => console.error('Error:', error));
    });

    // ========================== Delete Checklist ==========================
    document.querySelectorAll('.delete-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            const checklistId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('checklist.destroy','') }}/${checklistId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.querySelector(`[data-id="${checklistId}"]`).remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Checklist item has been deleted.',
                                timer: 2000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to delete the checklist item.',
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    });
});













</script>
@endpush