@extends('layouts.public')
@section('title', $artikel->judul)

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-wrap gap-2 text-gray-400 text-sm mb-4">
            <a href="{{ route('home') }}" class="hover:text-gold-600">Beranda</a> /
            <a href="{{ route('artikel.index') }}" class="hover:text-gold-600">Artikel</a> /
            <span class="text-gray-600">{{ Str::limit($artikel->judul, 40) }}</span>
        </div>
        <span class="badge-gold mb-4 inline-block">{{ $artikel->kategori_label }}</span>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $artikel->judul }}</h1>
        <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-6">
            @if($artikel->penulis)<span>✍️ {{ $artikel->penulis }}</span>@endif
            <span>📅 {{ $artikel->published_at?->format('d M Y') }}</span>
            <span>👁 {{ number_format($artikel->views) }} kali dibaca</span>
        </div>
        <img src="{{ $artikel->gambar_url }}" alt="{{ $artikel->judul }}" class="w-full h-72 object-cover rounded-2xl mb-8">
        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $artikel->konten !!}
        </div>

        {{-- Artikel Lain --}}
        @if($artikelLain->count() > 0)
        <div class="mt-12 pt-8 border-t border-gray-200">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Artikel Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($artikelLain as $a)
                <div class="card group">
                    <div class="overflow-hidden h-36">
                        <img src="{{ $a->thumbnail_url }}" alt="{{ $a->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-4">
                        <h4 class="font-semibold text-gray-800 text-sm line-clamp-2 mb-2">{{ $a->judul }}</h4>
                        <a href="{{ route('artikel.show', $a->slug) }}" class="text-gold-600 text-xs font-semibold hover:text-gold-700">Baca →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
