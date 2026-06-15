@extends('layouts.public')
@section('title', 'Tim Pembimbing')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Tim Pembimbing</h1>
        <p class="text-gold-200">Pembimbing profesional berpengalaman untuk perjalanan ibadah Anda</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    @if($pembimbings->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($pembimbings as $p)
        <div class="card p-6 text-center">
            <div class="w-28 h-28 rounded-full overflow-hidden mx-auto mb-4 border-4 border-gold-200">
                <img src="{{ $p->thumbnail_url }}" alt="{{ $p->nama }}" class="w-full h-full object-cover">
            </div>
            <h3 class="font-bold text-gray-800 text-lg">{{ $p->nama_lengkap }}</h3>
            <p class="text-gold-600 text-sm font-medium">{{ $p->jabatan }}</p>
            @if($p->bio)
            <p class="text-gray-500 text-sm mt-2 line-clamp-3">{{ $p->bio }}</p>
            @endif
            <div class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-2 gap-2 text-center">
                <div>
                    <div class="text-xl font-bold text-gold-600">{{ $p->pengalaman_tahun }}</div>
                    <div class="text-xs text-gray-400">Tahun Pengalaman</div>
                </div>
                <div>
                    <div class="text-xl font-bold text-gold-600">{{ number_format($p->total_jamaah) }}</div>
                    <div class="text-xs text-gray-400">Jamaah Dibimbing</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @for($i = 0; $i < 4; $i++)
        <div class="card p-6 text-center">
            <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4 bg-gold-100 flex items-center justify-center">
                <span class="text-4xl">👨‍🏫</span>
            </div>
            <h3 class="font-bold text-gray-700">Ust. Pembimbing</h3>
            <p class="text-gold-600 text-sm">Pembimbing Senior</p>
            <p class="text-gray-400 text-xs mt-2">10+ tahun pengalaman</p>
        </div>
        @endfor
    </div>
    @endif
</div>
@endsection
