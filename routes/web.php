<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PaketController;
use App\Http\Controllers\Public\ArtikelController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\HotelController;
use App\Http\Controllers\Public\TestimoniController;
use App\Http\Controllers\Public\KontakController;

/*
|--------------------------------------------------------------------------
| Web Routes - Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Paket
Route::prefix('paket')->name('paket.')->group(function () {
    Route::get('/', [PaketController::class, 'index'])->name('index');
    Route::get('/{slug}', [PaketController::class, 'show'])->name('show');
});

// Artikel / Blog
Route::prefix('artikel')->name('artikel.')->group(function () {
    Route::get('/', [ArtikelController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArtikelController::class, 'show'])->name('show');
});

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// Hotel
Route::prefix('hotel')->name('hotel.')->group(function () {
    Route::get('/', [HotelController::class, 'index'])->name('index');
    Route::get('/{slug}', [HotelController::class, 'show'])->name('show');
});

// Pembimbing
Route::get('/pembimbing', [App\Http\Controllers\Public\PembimbingController::class, 'index'])->name('pembimbing.index');

// Testimoni
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');

// FAQ
Route::get('/faq', [App\Http\Controllers\Public\FaqController::class, 'index'])->name('faq.index');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [KontakController::class, 'kirim'])->name('kontak.kirim');
