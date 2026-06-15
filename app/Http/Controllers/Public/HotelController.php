<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotelMakkah  = Hotel::aktif()->makkah()->orderBy('bintang', 'desc')->get();
        $hotelMadinah = Hotel::aktif()->madinah()->orderBy('bintang', 'desc')->get();

        return view('public.hotel.index', compact('hotelMakkah', 'hotelMadinah'));
    }

    public function show(string $slug)
    {
        $hotel = Hotel::aktif()->where('slug', $slug)->firstOrFail();
        return view('public.hotel.show', compact('hotel'));
    }
}
