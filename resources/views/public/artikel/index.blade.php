@extends('layouts.public')
@section('title', 'Artikel & Blog')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Artikel & Blog</h1>
        <p class="text-gold-200">Tips, panduan, dan informasi seputar haji & umrah</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    {{-- Filter --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-8">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel..." class="border border-gray-200 rounded-lg px-4 py-2 text-sm flex-1 min-w-48">
        <select name="kategori" class="border border-gray-200 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $v => $l)
            <option value="{{ $v }}" {{ request('kategori') == $v ? 'selected' : '' }}>{{ $l }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn-gold text-sm">Cari</button>
    </form>

    @if($artikels->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($artikels as $artikel)
        <div class="card group">
            <div class="overflow-hidden h-48">
                <img src="{{ $artikel->thumbnail_url }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-5">
                <span class="badge-gold mb-2 inline-block text-xs">{{ $artikel->kategori_label }}</span>
                <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $artikel->judul }}</h3>
                <p class="text-gray-500 text-sm line-clamp-3 mb-4">{{ $artikel->ringkasan }}</p>
                <div class="flex justify-between items-center text-xs text-gray-400">
                    <span>{{ $artikel->published_at?->format('d M Y') }}</span>
                    <a href="{{ route('artikel.show', $artikel->slug) }}" class="text-gold-600 font-semibold hover:text-gold-700">Baca Selengkapnya →</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $artikels->links() }}</div>
    @else
    <div class="text-center py-16">
        <div class="text-6xl mb-4">📄</div>
        <p class="text-gray-500">Belum ada artikel tersedia.</p>
    </div>
    @endif
</div>
@endsection
