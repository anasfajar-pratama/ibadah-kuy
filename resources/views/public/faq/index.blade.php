@extends('layouts.public')
@section('title', 'FAQ - Pertanyaan Umum')

@section('content')
<div class="bg-gradient-to-r from-gold-700 to-gold-900 py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">FAQ</h1>
        <p class="text-gold-200">Jawaban atas pertanyaan yang sering diajukan</p>
    </div>
</div>

<div class="container mx-auto px-4 py-10 max-w-4xl">
    @if($faqs->count() > 0)
        @foreach($faqs as $kategori => $items)
        <div class="mb-10">
            <h2 class="text-xl font-bold text-gold-700 mb-4 border-b-2 border-gold-200 pb-2">
                {{ match($kategori) {
                    'umum' => '🔵 Umum',
                    'haji' => '🕌 Haji',
                    'umrah' => '🕋 Umrah',
                    'pembayaran' => '💳 Pembayaran',
                    'dokumen' => '📄 Dokumen',
                    default => '📌 Lainnya'
                } }}
            </h2>
            <div class="space-y-3" x-data>
                @foreach($items as $faq)
                <div class="card" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full px-6 py-4 flex justify-between items-center text-left hover:bg-gold-50 transition-colors">
                        <span class="font-semibold text-gray-800">{{ $faq->pertanyaan }}</span>
                        <svg class="w-5 h-5 text-gold-500 flex-shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-transition class="px-6 pb-4">
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $faq->jawaban }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @else
    <div class="text-center py-16"><div class="text-6xl mb-4">❓</div><p class="text-gray-500">Belum ada FAQ tersedia.</p></div>
    @endif

    <div class="card-gold p-8 text-center mt-10">
        <h3 class="text-xl font-bold text-gray-800 mb-2">Masih ada pertanyaan?</h3>
        <p class="text-gray-500 mb-4">Tim kami siap membantu Anda menjawab semua pertanyaan.</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-green-600 transition">💬 Chat WhatsApp</a>
            <a href="{{ route('kontak.index') }}" class="btn-gold-outline">📧 Kirim Email</a>
        </div>
    </div>
</div>
@endsection
