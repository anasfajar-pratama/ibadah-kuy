@extends('layouts.public')
@section('title', 'Hotel Makkah & Madinah')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Hotel & Akomodasi</h1>
        <p class="text-gold-200">Hotel pilihan terbaik di Makkah dan Madinah</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">🕋 Hotel di Makkah Al-Mukarramah</h2>
        <div class="section-gold-line"></div>
        @if($hotelMakkah->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($hotelMakkah as $hotel)
            <div class="card group">
                <div class="overflow-hidden h-48 relative">
                    <img src="{{ $hotel->thumbnail_url }}" alt="{{ $hotel->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-3 right-3 bg-gold-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $hotel->bintang }}★</div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 mb-1">{{ $hotel->nama }}</h3>
                    <p class="text-gold-600 text-sm font-medium mb-2">📍 {{ $hotel->jarak_ke_masjid }} dari Masjidil Haram</p>
                    <p class="text-gray-500 text-sm line-clamp-2">{{ $hotel->deskripsi }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @for($i = 0; $i < 3; $i++)
            <div class="card">
                <div class="img-placeholder h-48"><div class="text-center text-gold-400"><div class="text-5xl">🏨</div><p class="text-sm mt-2">Hotel Makkah</p></div></div>
                <div class="p-5"><div class="text-gold-500 font-bold">★★★★★</div><h3 class="font-bold text-gray-700 mt-1">Hotel Bintang 5 Makkah</h3><p class="text-gold-600 text-sm mt-1">📍 100m dari Masjidil Haram</p></div>
            </div>
            @endfor
        </div>
        @endif
    </div>

    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">🕌 Hotel di Madinah Al-Munawwarah</h2>
        <div class="section-gold-line"></div>
        @if($hotelMadinah->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($hotelMadinah as $hotel)
            <div class="card group">
                <div class="overflow-hidden h-48 relative">
                    <img src="{{ $hotel->thumbnail_url }}" alt="{{ $hotel->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-3 right-3 bg-gold-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $hotel->bintang }}★</div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 mb-1">{{ $hotel->nama }}</h3>
                    <p class="text-gold-600 text-sm font-medium mb-2">📍 {{ $hotel->jarak_ke_masjid }} dari Masjid Nabawi</p>
                    <p class="text-gray-500 text-sm line-clamp-2">{{ $hotel->deskripsi }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            @for($i = 0; $i < 3; $i++)
            <div class="card">
                <div class="img-placeholder h-48"><div class="text-center text-gold-400"><div class="text-5xl">🏨</div><p class="text-sm mt-2">Hotel Madinah</p></div></div>
                <div class="p-5"><div class="text-gold-500 font-bold">★★★★☆</div><h3 class="font-bold text-gray-700 mt-1">Hotel Bintang 4 Madinah</h3><p class="text-gold-600 text-sm mt-1">📍 200m dari Masjid Nabawi</p></div>
            </div>
            @endfor
        </div>
        @endif
    </div>
</div>
@endsection
