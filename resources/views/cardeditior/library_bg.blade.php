<?php
$directory = "assets/images/pattern/";

$directory_images = glob($directory . "*.jpg");
foreach ($directory_images as $img) {
    echo '<div class="pg-imglist-item"><div class="ed_image pg_canvas_bg_image" data-url="' . url($directory . basename($img)) . '"><img src="' . url($img) . '" alt="' . e(__('Images loaded from library background')) . '"></div></div>';
}

$directory_images = glob($directory . "*.png");
foreach ($directory_images as $img) {
    echo '<div class="pg-imglist-item"><div class="ed_image pg_canvas_bg_image" data-url="' . url($directory . basename($img)) . '"><img src="' . url($img) . '" alt="' . e(__('Images loaded from library background')) . '"></div></div>';
}

$directory_images = glob($directory . "*.svg");
foreach ($directory_images as $img) {
    echo '<div class="pg-imglist-item"><div class="ed_image pg_canvas_bg_image" data-url="' . url($directory . basename($img)) . '"><img src="' . url($img) . '" alt="' . e(__('Images loaded from library background')) . '"></div></div>';
}
?>