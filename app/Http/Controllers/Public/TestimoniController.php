<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::aktif()->with('paket')->orderBy('urutan')->paginate(12);
        return view('public.testimoni.index', compact('testimonis'));
    }
}
