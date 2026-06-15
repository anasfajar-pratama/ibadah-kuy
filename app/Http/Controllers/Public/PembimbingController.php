<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pembimbing;

class PembimbingController extends Controller
{
    public function index()
    {
        $pembimbings = Pembimbing::aktif()->orderBy('urutan')->get();
        return view('public.pembimbing.index', compact('pembimbings'));
    }
}
