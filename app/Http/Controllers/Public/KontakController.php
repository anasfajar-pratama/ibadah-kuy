<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('public.kontak.index');
    }

    public function kirim(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email',
            'no_hp'   => 'nullable|string|max:20',
            'subjek'  => 'required|string|max:200',
            'pesan'   => 'required|string|max:2000',
        ]);

        // TODO: simpan ke database atau kirim email
        // Untuk saat ini cukup flash message
        return back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan menghubungi Anda segera.');
    }
}
