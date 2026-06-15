@extends('layouts.public')
@section('title', 'Galeri Foto')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Galeri Foto</h1>
        <p class="text-gold-200">Kenangan perjalanan ibadah jamaah ibadah-Kuy</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <form method="GET" class="flex flex-wrap gap-3 mb-8">
        <select name="kategori" class="border border-gray-200 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $v => $l)
            <option value="{{ $v }}" {{ request('kategori') == $v ? 'selected' : '' }}>{{ $l }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-gold text-sm">Filter</button>
    </form>

    @if($galeris->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data>
        @foreach($galeris as $galeri)
        <div class="group relative overflow-hidden rounded-xl cursor-pointer" @click="$dispatch('open-lightbox', { src: '{{ $galeri->gambar_url }}', alt: '{{ $galeri->judul }}' })">
            <img src="{{ $galeri->thumbnail_url }}" alt="{{ $galeri->judul }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300 flex items-end">
                <div class="p-3 text-white opacity-0 group-hover:opacity-100 transition-opacity">
                    <p class="text-sm font-semibold">{{ $galeri->judul }}</p>
                    @if($galeri->lokasi)<p class="text-xs">{{ $galeri->lokasi }}</p>@endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $galeris->links() }}</div>
    @else
    <div class="text-center py-16"><div class="text-6xl mb-4">📷</div><p class="text-gray-500">Belum ada foto di galeri.</p></div>
    @endif
</div>
@endsection
