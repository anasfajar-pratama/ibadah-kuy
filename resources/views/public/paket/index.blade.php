@extends('layouts.public')
@section('title', 'Paket Haji & Umrah')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Paket Haji & Umrah</h1>
        <p class="text-gold-200">Temukan paket perjalanan ibadah yang sesuai untuk Anda</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Filter --}}
        <aside class="lg:w-64 flex-shrink-0">
            <form method="GET" class="card p-5 sticky top-20">
                <h3 class="font-bold text-gray-800 mb-4">Filter Paket</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Paket</label>
                    <select name="jenis" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        <option value="">Semua Jenis</option>
                        <optgroup label="Haji">
                            @foreach(['haji_reguler' => 'Haji Reguler', 'haji_plus' => 'Haji Plus', 'haji_furoda' => 'Haji Furoda'] as $v => $l)
                            <option value="{{ $v }}" {{ request('jenis') == $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Umrah">
                            @foreach(['umrah_reguler' => 'Umrah Reguler', 'umrah_plus' => 'Umrah Plus', 'umrah_ramadan' => 'Umrah Ramadan', 'umrah_custom' => 'Umrah Custom'] as $v => $l)
                            <option value="{{ $v }}" {{ request('jenis') == $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <button type="submit" class="btn-gold w-full justify-center text-sm">Terapkan Filter</button>
                <a href="{{ route('paket.index') }}" class="block text-center text-xs text-gray-400 mt-2 hover:text-gold-600">Reset Filter</a>
            </form>
        </aside>

        {{-- List --}}
        <div class="flex-1">
            @if($pakets->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($pakets as $paket)
                <div class="paket-card">
                    <div class="relative overflow-hidden h-48">
                        <img src="{{ $paket->thumbnail_url }}" alt="{{ $paket->nama }}" class="paket-image">
                        <div class="absolute top-3 left-3"><span class="badge-gold">{{ $paket->jenis_label }}</span></div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-800 mb-1">{{ $paket->nama }}</h3>
                        <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $paket->deskripsi }}</p>
                        <div class="flex flex-wrap gap-2 text-xs text-gray-500 mb-4">
                            <span>🗓 {{ $paket->durasi_hari }} Hari</span>
                            @if($paket->maskapai)<span>✈️ {{ $paket->maskapai }}</span>@endif
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs text-gray-400">Mulai dari</div>
                                <div class="text-xl font-bold text-gold-600">{{ $paket->harga_format }}</div>
                            </div>
                            <a href="{{ route('paket.show', $paket->slug) }}" class="btn-gold text-sm">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $pakets->links() }}</div>
            @else
            <div class="text-center py-16">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-bold text-gray-600">Paket tidak ditemukan</h3>
                <p class="text-gray-400 mt-2">Coba ubah filter pencarian Anda</p>
                <a href="{{ route('paket.index') }}" class="btn-gold mt-4">Lihat Semua Paket</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
