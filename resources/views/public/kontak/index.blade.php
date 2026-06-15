@extends('layouts.public')
@section('title', 'Kontak Kami')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Kontak Kami</h1>
        <p class="text-gold-200">Kami siap membantu perjalanan ibadah Anda</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        {{-- Info --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Hubungi ibadah-Kuy</h2>
            <div class="space-y-5">
                @foreach([
                    ['icon' => '📍', 'title' => 'Alamat Kantor', 'content' => 'Jl. Contoh No. 123, Jakarta Selatan 12345'],
                    ['icon' => '📞', 'title' => 'Telepon / WhatsApp', 'content' => '+62 812-3456-7890'],
                    ['icon' => '✉️', 'title' => 'Email', 'content' => 'info@ibadahkuy.com'],
                    ['icon' => '🕐', 'title' => 'Jam Operasional', 'content' => 'Senin – Sabtu: 08.00 – 17.00 WIB'],
                ] as $item)
                <div class="flex gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gold-100 flex items-center justify-center text-2xl flex-shrink-0">{{ $item['icon'] }}</div>
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $item['title'] }}</h4>
                        <p class="text-gray-500 text-sm">{{ $item['content'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8">
                <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-600 transition flex items-center gap-2 w-fit">
                    💬 Chat via WhatsApp Sekarang
                </a>
            </div>
        </div>

        {{-- Form --}}
        <div class="card p-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
            <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-gold-400" required>
                        @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-gold-400">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-gold-400" required>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subjek *</label>
                    <input type="text" name="subjek" value="{{ old('subjek') }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-gold-400" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pesan *</label>
                    <textarea name="pesan" rows="5" class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-gold-400" required>{{ old('pesan') }}</textarea>
                </div>
                <button type="submit" class="btn-gold w-full justify-center">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection
