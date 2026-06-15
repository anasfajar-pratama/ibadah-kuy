<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index(Request $request)
    {
        $query = Paket::aktif()->with('jadwals');

        if ($request->jenis) {
            if ($request->jenis === 'haji') {
                $query->haji();
            } elseif ($request->jenis === 'umrah') {
                $query->umrah();
            } else {
                $query->where('jenis', $request->jenis);
            }
        }

        if ($request->min_harga) {
            $query->where('harga', '>=', $request->min_harga);
        }
        if ($request->max_harga) {
            $query->where('harga', '<=', $request->max_harga);
        }

        $pakets = $query->orderBy('urutan')->orderBy('harga')->paginate(12);
        $jenisList = [
            'haji_reguler' => 'Haji Reguler',
            'haji_plus' => 'Haji Plus',
            'haji_furoda' => 'Haji Furoda',
            'umrah_reguler' => 'Umrah Reguler',
            'umrah_plus' => 'Umrah Plus',
            'umrah_ramadan' => 'Umrah Ramadan',
            'umrah_custom' => 'Umrah Custom',
        ];

        return view('public.paket.index', compact('pakets', 'jenisList'));
    }

    public function show(string $slug)
    {
        $paket = Paket::aktif()
            ->with(['jadwals' => fn($q) => $q->where('status', '!=', 'selesai')->orderBy('tanggal_berangkat')])
            ->where('slug', $slug)
            ->firstOrFail();

        $paketLain = Paket::aktif()
            ->where('id', '!=', $paket->id)
            ->where('jenis', $paket->jenis)
            ->limit(3)->get();

        return view('public.paket.show', compact('paket', 'paketLain'));
    }
}
