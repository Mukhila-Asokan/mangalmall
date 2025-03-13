<div class="card p-3 m-3  border-0">
    <div class="card-header pb-1 pr-3">
        <div class="row">
            <div class="col-md-6 d-flex">
                <span class="font-20 font-color font-weight-bold">Guest Groups</span>
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between row mb-4">
        <div class="mb-2 col-7 d-flex">
            <div class="input-group">
                <input type="text" id="search_guest_group_value" class="form-control" placeholder="Search Guest group details here..." aria-label="Search Guest details here..." aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" id="search_guest_group_details" type="button"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <button class="btn btn-primary ml-2 font-14 clear_search" type="button">Clear</button>
        </div>
    </div>
    <div class="row d-flex justify-content contact-list">
        @foreach($guestGroups as $group)
            <div class="col-3 mb-4">
                <div class="card contact-card m-1">
                    <div class="card-header m-2">
                        <div class="row">
                            <div class="col-8 text-start d-flex">
                                <i class="bi bi-people-fill font-14"></i>
                                <span class="font-14 font-weight-bold ml-1">{{$group->group_name}}</span>
                            </div>
                            <div class="col-4 d-flex justify-content-end align-items-center">
                                <a id="add_group" data-id="{{$group->id}}" class="add_group_contact pointer"><i class="bi bi-person-plus-fill font-20"></i></a>
                                <a id="edit_group" class="edit_group ml-2 pointer" data-id="{{$group->id}}"><i class="bi bi-pencil-square font-20"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0 p-0">
                    <div class="card-body p-2 mb-2">
                        <div class="row mt-2">
                            <div class="col-md-12 d-flex">
                                <i class="bi bi-file-earmark-text font-12"></i>
                                <span class="font-12 ml-1">{{ Str::limit($group->group_description, 30, '...') ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="row d-flex">
                            <div class="col-md-6 d-flex justify-content-start p-0">
                                <a id="delete_group" class="delete_group ml-2 pointer" data-id="{{$group->id}}">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end p-0">
                                <button class="btn btn-primary waves-effect waves-light text-end ml-1 pl-2 pr-2 pt-1 pb-1 font-12 view_group" id="view_group" data-id="{{$group->id}}">
                                    View Group
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if(count($guestGroups) == 0)
        <div class="col-12 text-center">
            <div class="">No groups found</div>
        </div>
    @endif
    @if(count($guestGroups) > 30)
        <div class="col-12 d-flex justify-content-center mt-4">
            <a href="" class="btn primary-solid-btn text-center load_more_groups w-25">Load More</a>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        $(document).on('click', '#search_guest_group_details', function(){
            var value = $('#search_guest_group_value').val();
            $.ajax({
                url: "{{ route('guest.group.search') }}",
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
    </script>
@endpush