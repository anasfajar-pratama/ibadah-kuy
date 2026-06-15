@extends('layouts.public')
@section('title', $paket->nama)

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-8 text-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap gap-2 text-gold-300 text-sm mb-2">
            <a href="{{ route('home') }}" class="hover:text-white">Beranda</a> /
            <a href="{{ route('paket.index') }}" class="hover:text-white">Paket</a> /
            <span>{{ $paket->nama }}</span>
        </div>
        <h1 class="text-3xl font-bold">{{ $paket->nama }}</h1>
        <span class="badge-gold mt-2 inline-block">{{ $paket->jenis_label }}</span>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Detail --}}
        <div class="lg:col-span-2">
            <div class="card overflow-hidden mb-6">
                <img src="{{ $paket->gambar_url }}" alt="{{ $paket->nama }}" class="w-full h-72 object-cover">
            </div>

            {{-- Spesifikasi --}}
            <div class="card p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Spesifikasi Paket</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div class="bg-gold-50 rounded-xl p-3">
                        <div class="text-2xl mb-1">🗓</div>
                        <div class="font-bold text-gray-800">{{ $paket->durasi_hari }} Hari</div>
                        <div class="text-xs text-gray-500">Durasi</div>
                    </div>
                    @if($paket->maskapai)
                    <div class="bg-gold-50 rounded-xl p-3">
                        <div class="text-2xl mb-1">✈️</div>
                        <div class="font-bold text-gray-800">{{ $paket->maskapai }}</div>
                        <div class="text-xs text-gray-500">{{ $paket->kelas_penerbangan }}</div>
                    </div>
                    @endif
                    @if($paket->hotel_makkah)
                    <div class="bg-gold-50 rounded-xl p-3">
                        <div class="text-2xl mb-1">🏨</div>
                        <div class="font-bold text-gray-800">{{ $paket->bintang_hotel_makkah }}★</div>
                        <div class="text-xs text-gray-500">Hotel Makkah</div>
                    </div>
                    @endif
                    @if($paket->hotel_madinah)
                    <div class="bg-gold-50 rounded-xl p-3">
                        <div class="text-2xl mb-1">🏨</div>
                        <div class="font-bold text-gray-800">{{ $paket->bintang_hotel_madinah }}★</div>
                        <div class="text-xs text-gray-500">Hotel Madinah</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="card p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Deskripsi Paket</h2>
                <p class="text-gray-600 leading-relaxed">{{ $paket->deskripsi }}</p>
                @if($paket->detail)
                <div class="mt-4 prose max-w-none text-gray-600">{!! $paket->detail !!}</div>
                @endif
            </div>

            {{-- Fasilitas --}}
            @if($paket->fasilitas)
            <div class="card p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Fasilitas</h2>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($paket->fasilitas as $f)
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <span class="text-green-500">✓</span> {{ is_array($f) ? $f['item'] : $f }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Jadwal --}}
            @if($paket->jadwals->count() > 0)
            <div class="card p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Jadwal Keberangkatan</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead><tr class="bg-gold-50"><th class="px-4 py-2 text-left">Berangkat</th><th class="px-4 py-2 text-left">Kembali</th><th class="px-4 py-2 text-left">Maskapai</th><th class="px-4 py-2 text-left">Sisa Kursi</th><th class="px-4 py-2"></th></tr></thead>
                        <tbody>
                            @foreach($paket->jadwals as $j)
                            <tr class="border-b border-gray-100">
                                <td class="px-4 py-3 font-medium">{{ $j->tanggal_berangkat->format('d M Y') }}</td>
                                <td class="px-4 py-3">{{ $j->tanggal_kembali->format('d M Y') }}</td>
                                <td class="px-4 py-3">{{ $j->maskapai }}</td>
                                <td class="px-4 py-3">
                                    <span class="badge-{{ $j->sisa_kursi > 5 ? 'green' : 'gold' }}">{{ $j->sisa_kursi }} kursi</span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="https://wa.me/6281234567890?text=Halo ibadah-Kuy, saya ingin booking paket {{ $paket->nama }} keberangkatan {{ $j->tanggal_berangkat->format('d M Y') }}" target="_blank" class="btn-gold text-xs py-1">Booking</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="card p-6 sticky top-20">
                <div class="text-xs text-gray-400 mb-1">Harga mulai dari</div>
                <div class="text-3xl font-bold text-gold-600 mb-1">{{ $paket->harga_format }}</div>
                <div class="text-xs text-gray-400 mb-6">/orang</div>
                <div class="space-y-3">
                    <a href="https://wa.me/6281234567890?text=Halo ibadah-Kuy, saya ingin info lebih lanjut tentang paket {{ $paket->nama }}" target="_blank" class="btn-gold w-full justify-center">
                        💬 Tanya via WhatsApp
                    </a>
                    <a href="{{ route('kontak.index') }}" class="btn-gold-outline w-full justify-center">
                        📋 Minta Brosur
                    </a>
                </div>
                <hr class="my-4 border-gold-100">
                <div class="text-sm text-gray-500 space-y-2">
                    <div class="flex justify-between"><span>Sisa Kursi</span><strong>{{ $paket->sisa_kursi }}</strong></div>
                    @if($paket->hotel_makkah)<div class="flex justify-between"><span>Hotel Makkah</span><strong>{{ $paket->hotel_makkah }}</strong></div>@endif
                    @if($paket->hotel_madinah)<div class="flex justify-between"><span>Hotel Madinah</span><strong>{{ $paket->hotel_madinah }}</strong></div>@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
