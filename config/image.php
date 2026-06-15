<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Kompresi Gambar ibadah-Kuy
    |--------------------------------------------------------------------------
    */

    // Dimensi maksimum gambar utama
    'max_width'  => env('IMAGE_MAX_WIDTH', 1920),
    'max_height' => env('IMAGE_MAX_HEIGHT', 1080),

    // Kualitas JPEG (0-100, direkomendasikan 75-85)
    'quality' => env('IMAGE_QUALITY', 80),

    // Dimensi thumbnail
    'thumbnail_width'  => env('IMAGE_THUMBNAIL_WIDTH', 400),
    'thumbnail_height' => env('IMAGE_THUMBNAIL_HEIGHT', 300),
];
