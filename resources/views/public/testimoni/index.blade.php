@extends('layouts.public')
@section('title', 'Testimoni Jamaah')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Testimoni Jamaah</h1>
        <p class="text-gold-200">Cerita dan pengalaman jamaah yang telah berangkat bersama ibadah-Kuy</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    @if($testimonis->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($testimonis as $t)
        <div class="card-gold p-6">
            <div class="text-gold-400 text-xl mb-3">
                @for($i = 1; $i <= 5; $i++)
                    <span class="{{ $i <= $t->rating ? 'text-gold-400' : 'text-gray-300' }}">★</span>
                @endfor
            </div>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">"{{ $t->isi }}"</p>
            <div class="flex items-center gap-3 mt-auto">
                <div class="w-12 h-12 rounded-full overflow-hidden bg-gold-200 flex-shrink-0">
                    <img src="{{ $t->foto_url }}" alt="{{ $t->nama }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="font-semibold text-gray-800">{{ $t->nama }}</div>
                    <div class="text-xs text-gray-400">
                        {{ $t->asal_kota }}
                        @if($t->paket) · {{ $t->paket->jenis_label }} @endif
                        @if($t->tahun) · {{ $t->tahun }} @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">{{ $testimonis->links() }}</div>
    @else
    <div class="text-center py-16">
        <div class="text-6xl mb-4">💬</div>
        <p class="text-gray-500">Belum ada testimoni tersedia.</p>
    </div>
    @endif

    <div class="mt-12 card-gold p-8 text-center">
        <h3 class="text-xl font-bold text-gray-800 mb-2">Sudah Pernah Berangkat Bersama Kami?</h3>
        <p class="text-gray-500 mb-4">Bagikan pengalaman ibadah Anda dan bantu calon jamaah lainnya.</p>
        <a href="https://wa.me/6281234567890?text=Halo ibadah-Kuy, saya ingin berbagi testimoni perjalanan saya" target="_blank" class="btn-gold">
            💬 Kirim Testimoni via WhatsApp
        </a>
    </div>
</div>
@endsection
