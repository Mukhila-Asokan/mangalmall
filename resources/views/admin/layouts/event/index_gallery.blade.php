<?php use App\Models\UserChecklist; ?>
@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div class="row">
        @include('profile-layouts.sticky')
            <div class="col-lg-11 col-md-11 stickymenucontent">
                <center>
                    <h3 class="text-center">Event Gallery Board</h3>
                </center>
                    @foreach($events as $occasion)
                        <div class="col-md-12 mb-12">
                            <div class="card shadow-lg border-0 rounded-3 p-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="mb-0 font-color">{{ $occasion->occasion_name }}</h4>
                                        <a href="{{ route('home.gallery.add', ['event_id' => $occasion->id]) }}" 
                                            class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus mt-1"></i> Add Gallery
                                        </a>
                                    </div>
                                    <span class="text-muted font-14">Event - {{ $occasion->Occasionname->eventtypename }}</span>
                                    <hr class="my-3">
                                    <section class="image-grid">
                                        <div class="container-xxl">
                                            <div class="row gy-4">
                                                @foreach($occasion->occasionGallery as $gallery)
                                                    <div class="col-12 col-sm-6 col-md-3 mb-2">
                                                        <figure>
                                                        <a class="d-block" href="#">
                                                            <img src="{{ asset('storage/'.$gallery->gallery_image) }}" class="img-fluid image-preview-list" data-caption="Ring of Kerry, County Kerry, Ireland">
                                                        </a>
                                                        </figure>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lightbox-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="homemodal-content bg-transparent border-0 shadow-none">
            <div class="card">
                <div class="modal-header">
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <img id="lightbox-image" src="" class="img-fluid rounded border border-dark"">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-2 col-md-2">
   @include('profile-layouts.rightside')
</div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll(".image-preview-list");
            const lightboxImage = document.getElementById("lightbox-image");
            const lightboxModal = new bootstrap.Modal(document.getElementById("lightbox-modal"));

            images.forEach(img => {
                img.addEventListener("click", function () {
                    lightboxImage.src = this.src;
                    lightboxModal.show();
                });
            });
        });

        $(document).on("click", ".btn-close", function () {
            $(".modal").modal("hide");
        });
    </script>
@endpush