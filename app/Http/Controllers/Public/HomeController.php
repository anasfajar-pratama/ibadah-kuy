<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Paket;
use App\Models\Testimoni;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Pembimbing;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::aktif()->orderBy('urutan')->get();
        $paketFeatured = Paket::aktif()->featured()->orderBy('urutan')->limit(6)->get();
        $paketHaji = Paket::aktif()->haji()->orderBy('harga')->limit(3)->get();
        $paketUmrah = Paket::aktif()->umrah()->orderBy('harga')->limit(3)->get();
        $testimoni = Testimoni::aktif()->featured()->orderBy('urutan')->limit(6)->get();
        $artikelTerbaru = Artikel::published()->orderBy('published_at', 'desc')->limit(3)->get();
        $galeri = Galeri::aktif()->where('is_featured', true)->orderBy('urutan')->limit(8)->get();
        $pembimbing = Pembimbing::aktif()->orderBy('urutan')->limit(4)->get();

        $stats = [
            'total_jamaah' => \App\Models\Jamaah::count(),
            'total_paket'  => Paket::aktif()->count(),
            'tahun_berdiri' => 2010,
            'cabang'        => 5,
        ];

        return view('public.home', compact(
            'banners', 'paketFeatured', 'paketHaji', 'paketUmrah',
            'testimoni', 'artikelTerbaru', 'galeri', 'pembimbing', 'stats'
        ));
    }
}
