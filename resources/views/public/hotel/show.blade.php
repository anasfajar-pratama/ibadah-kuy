@extends('layouts.public')
@section('title', $hotel->nama)

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-8 text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap gap-2 text-gold-300 text-sm mb-2">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a> /
            <a href="{{ route('hotel.index') }}" class="hover:text-white">Hotel</a> /
            <span>{{ $hotel->nama }}</span>
        </div>
        <h1 class="text-3xl font-bold">{{ $hotel->nama }}</h1>
        <div class="flex items-center gap-3 mt-2">
            <span class="text-gold-300">{{ $hotel->lokasi_label }}</span>
            <span class="text-gold-400">{{ $hotel->bintang_symbol }}</span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="card overflow-hidden mb-6">
                <img src="{{ $hotel->gambar_url }}" alt="{{ $hotel->nama }}" class="w-full h-72 object-cover">
            </div>
            @if($hotel->deskripsi)
            <div class="card p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-3">Tentang Hotel</h2>
                <p class="text-gray-600 leading-relaxed">{{ $hotel->deskripsi }}</p>
            </div>
            @endif
            @if($hotel->fasilitas)
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Fasilitas Hotel</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach($hotel->fasilitas as $f)
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span class="text-green-500 font-bold">✓</span>
                        {{ is_array($f) ? $f['item'] : $f }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div>
            <div class="card p-6 sticky top-20">
                <h3 class="font-bold text-gray-800 mb-4">Informasi Hotel</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex gap-2"><span class="text-gray-400 w-32">Lokasi</span><strong>{{ $hotel->lokasi_label }}</strong></div>
                    <div class="flex gap-2"><span class="text-gray-400 w-32">Bintang</span><strong class="text-gold-500">{{ $hotel->bintang_symbol }}</strong></div>
                    <div class="flex gap-2"><span class="text-gray-400 w-32">Jarak Masjid</span><strong>{{ $hotel->jarak_ke_masjid }}</strong></div>
                    @if($hotel->alamat)<div class="flex gap-2"><span class="text-gray-400 w-32">Alamat</span><span>{{ $hotel->alamat }}</span></div>@endif
                </div>
                <hr class="my-4 border-gold-100">
                <a href="{{ route('kontak.index') }}" class="btn-gold w-full justify-center">Tanya Ketersediaan</a>
            </div>
        </div>
    </div>
</div>
@endsection
