<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = Artikel::published();

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->q . '%')
                  ->orWhere('ringkasan', 'like', '%' . $request->q . '%');
            });
        }

        $artikels = $query->orderBy('published_at', 'desc')->paginate(9);

        $kategoriList = [
            'tips' => 'Tips & Trik',
            'panduan' => 'Panduan Ibadah',
            'info_visa' => 'Info Visa',
            'info_kesehatan' => 'Info Kesehatan',
            'berita' => 'Berita',
            'lainnya' => 'Lainnya',
        ];

        return view('public.artikel.index', compact('artikels', 'kategoriList'));
    }

    public function show(string $slug)
    {
        $artikel = Artikel::published()->where('slug', $slug)->firstOrFail();
        $artikel->increment('views');

        $artikelLain = Artikel::published()
            ->where('id', '!=', $artikel->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)->get();

        return view('public.artikel.show', compact('artikel', 'artikelLain'));
    }
}
