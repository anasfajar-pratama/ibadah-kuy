<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::aktif();

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $galeris = $query->orderBy('urutan')->orderBy('created_at', 'desc')->paginate(18);

        $kategoriList = [
            'ibadah' => 'Ibadah',
            'hotel' => 'Hotel',
            'transportasi' => 'Transportasi',
            'kuliner' => 'Kuliner',
            'wisata' => 'Wisata',
            'lainnya' => 'Lainnya',
        ];

        return view('public.galeri.index', compact('galeris', 'kategoriList'));
    }
}
