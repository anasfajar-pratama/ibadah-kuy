<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::aktif()->orderBy('urutan')->get()->groupBy('kategori');
        return view('public.faq.index', compact('faqs'));
    }
}
