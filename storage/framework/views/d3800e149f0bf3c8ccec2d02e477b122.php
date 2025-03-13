
<?php $__env->startSection('content'); ?>
<div class="mt-1 col-lg-10 col-md-10">
    <?php echo $__env->make('guest.caretaker.caretaker_list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
            <div class="modal-body">
                <div class="container add_caretaker_guest_section">
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" class="btn btn-primary add_guest_group_btn font-14">Submit</button>
                <button type="button" class="btn btn-secondary font-14" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).on('click', '#search_caretaker', function(){
            var value = $('#search_caretaker_value').val();
            alert(value);
            $.ajax({
                url: "<?php echo e(route('caretaker.search')); ?>",
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
            $.ajax({
                url: "<?php echo e(route('list.guest.caretaker')); ?>",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 'success'){
                        $('.add_caretaker_guest_section').empty();
                        var newGroupContacts = '';
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
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('profile-layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\mangalmall\mangalmall\resources\views/guest/caretaker/list.blade.php ENDPATH**/ ?>