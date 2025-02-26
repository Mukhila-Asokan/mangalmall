@php
    $directory = "assets/images/background/";
    $directory_images = glob($directory . "*.png");
@endphp

@foreach($directory_images as $img)
    <div class="pg-imglist-item">
        <div class="ed_image pg_canvas_add_image" data-url="{{ asset('assets/images/background/' . basename($img)) }}">
            <img src="{{ asset($img) }}" alt="library">
        </div>
    </div>
@endforeach

@php
    $directory = "assets/images/background/thumb/";
    $directory_images = glob($directory . "*.png");
@endphp

@foreach($directory_images as $img)
    <div class="pg-imglist-item">
        <div class="ed_image pg_canvas_add_image" data-url="{{ asset('assets/images/background/' . basename($img)) }}">
            <img src="{{ asset($img) }}" alt="library">
        </div>
    </div>
@endforeach

@php
    $directory_images = glob($directory . "*.svg");
@endphp

@foreach($directory_images as $img)
    <div class="pg-imglist-item">
        <div class="ed_image pg_canvas_add_image" data-url="{{ asset('assets/images/background/' . basename($img)) }}">
            <img src="{{ asset($img) }}" alt="library">
        </div>
    </div>
@endforeach