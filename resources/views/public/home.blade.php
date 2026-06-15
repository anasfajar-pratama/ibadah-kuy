@extends('layouts.public')

@section('title', 'Beranda')
@section('meta_description', 'ibadah-Kuy - Travel Haji & Umrah terpercaya. Paket lengkap, bimbingan profesional, akomodasi terbaik.')

@section('content')

{{-- Hero Slider --}}
<section class="relative">
    @if($banners->count() > 0)
    <div class="swiper hero-swiper h-[500px] md:h-[620px]">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
            <div class="swiper-slide relative">
                <img src="{{ $banner->gambar_url }}" alt="{{ $banner->judul }}" class="w-full h-full object-cover">
                <div class="hero-overlay"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-4">
                        <div class="max-w-2xl text-white">
                            <span class="badge-gold mb-4 inline-block">✨ Terpercaya & Berpengalaman</span>
                            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">{{ $banner->judul }}</h1>
                            @if($banner->subjudul)
                            <p class="text-lg md:text-xl text-white/90 mb-6">{{ $banner->subjudul }}</p>
                            @endif
                            @if($banner->link)
                            <a href="{{ $banner->link }}" class="btn-gold">
                                {{ $banner->teks_tombol ?? 'Lihat Selengkapnya' }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @else
    <div class="h-[500px] md:h-[620px] relative overflow-hidden">
        <div class="img-placeholder w-full h-full">
            <div class="text-center text-gold-600">
                <div class="text-8xl mb-4">🕌</div>
                <p class="text-2xl font-bold">ibadah-Kuy</p>
                <p class="text-lg">Travel Haji & Umrah Terpercaya</p>
            </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-4 text-white text-center md:text-left">
                <div class="max-w-2xl">
                    <span class="badge-gold mb-4 inline-block">✨ Terpercaya & Berpengalaman</span>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">Perjalanan Ibadah yang Berkesan Bersama ibadah-Kuy</h1>
                    <p class="text-lg text-white/90 mb-6">Melayani jamaah haji dan umrah dengan penuh dedikasi sejak 2010.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('paket.index') }}" class="btn-gold">Lihat Paket</a>
                        <a href="{{ route('kontak.index') }}" class="btn-white">Konsultasi Gratis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>

{{-- Stats --}}
<section class="bg-gold-500 py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-white">
            <div>
                <div class="text-3xl font-bold">{{ number_format($stats['total_jamaah']) }}+</div>
                <div class="text-gold-100 text-sm mt-1">Jamaah Dilayani</div>
            </div>
            <div>
                <div class="text-3xl font-bold">{{ $stats['total_paket'] }}+</div>
                <div class="text-gold-100 text-sm mt-1">Paket Tersedia</div>
            </div>
            <div>
                <div class="text-3xl font-bold">{{ date('Y') - $stats['tahun_berdiri'] }}+</div>
                <div class="text-gold-100 text-sm mt-1">Tahun Pengalaman</div>
            </div>
            <div>
                <div class="text-3xl font-bold">{{ $stats['cabang'] }}</div>
                <div class="text-gold-100 text-sm mt-1">Kantor Cabang</div>
            </div>
        </div>
    </div>
</section>

{{-- Paket Unggulan --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="badge-gold inline-block mb-3">Pilihan Terbaik</div>
            <h2 class="section-title">Paket Unggulan</h2>
            <div class="section-gold-line mx-auto"></div>
            <p class="section-subtitle max-w-xl mx-auto">Paket haji dan umrah pilihan dengan fasilitas terbaik untuk perjalanan ibadah yang berkesan</p>
        </div>

        @if($paketFeatured->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($paketFeatured as $paket)
            <div class="paket-card">
                <div class="relative overflow-hidden h-48">
                    <img src="{{ $paket->thumbnail_url }}" alt="{{ $paket->nama }}" class="paket-image">
                    <div class="absolute top-3 left-3">
                        <span class="badge-gold">{{ $paket->jenis_label }}</span>
                    </div>
                    @if($paket->sisa_kursi <= 5 && $paket->sisa_kursi > 0)
                    <div class="absolute top-3 right-3">
                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold">Sisa {{ $paket->sisa_kursi }} kursi</span>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-lg text-gray-800 mb-1 line-clamp-1">{{ $paket->nama }}</h3>
                    <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $paket->deskripsi }}</p>
                    <div class="flex flex-wrap gap-2 text-xs text-gray-500 mb-4">
                        <span class="flex items-center gap-1">🗓 {{ $paket->durasi_hari }} Hari</span>
                        @if($paket->maskapai)<span class="flex items-center gap-1">✈️ {{ $paket->maskapai }}</span>@endif
                        @if($paket->hotel_makkah)<span class="flex items-center gap-1">🏨 Hotel {{ $paket->bintang_hotel_makkah }}★</span>@endif
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
        @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for($i = 0; $i < 3; $i++)
            <div class="paket-card">
                <div class="img-placeholder h-48">
                    <div class="text-center text-gold-400"><div class="text-5xl">🕌</div><p class="text-sm mt-2">Foto Paket</p></div>
                </div>
                <div class="p-5">
                    <div class="badge-gold mb-2 inline-block">Umrah Reguler</div>
                    <h3 class="font-bold text-lg mb-2 text-gray-700">Paket Umrah Reguler {{ ['Ekonomis', 'Standar', 'Premium'][$i] }}</h3>
                    <p class="text-gray-400 text-sm mb-4">Paket ibadah umrah dengan fasilitas lengkap dan pembimbing berpengalaman.</p>
                    <div class="flex items-center justify-between">
                        <div class="text-xl font-bold text-gold-600">Rp 25.000.000</div>
                        <span class="btn-gold text-sm opacity-50 cursor-default">Detail</span>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        @endif

        <div class="text-center mt-8">
            <a href="{{ route('paket.index') }}" class="btn-gold-outline">
                Lihat Semua Paket
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- Kenapa Pilih Kami --}}
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="badge-gold inline-block mb-3">Keunggulan Kami</div>
                <h2 class="section-title">Mengapa Pilih ibadah-Kuy?</h2>
                <div class="section-gold-line"></div>
                <p class="text-gray-500 mb-8">Kami berkomitmen memberikan pelayanan terbaik agar perjalanan ibadah Anda menjadi pengalaman yang tak terlupakan.</p>
                <div class="space-y-4">
                    @foreach([
                        ['icon' => '🏆', 'title' => 'Izin Resmi PPIU', 'desc' => 'Terdaftar dan berizin resmi dari Kementerian Agama RI'],
                        ['icon' => '👨‍🏫', 'title' => 'Pembimbing Berpengalaman', 'desc' => 'Tim pembimbing profesional dengan pengalaman bertahun-tahun'],
                        ['icon' => '🏨', 'title' => 'Hotel Bintang 5', 'desc' => 'Akomodasi premium dekat Masjidil Haram dan Nabawi'],
                        ['icon' => '💰', 'title' => 'Harga Transparan', 'desc' => 'Tidak ada biaya tersembunyi, semua tercantum jelas'],
                    ] as $item)
                    <div class="flex gap-4 items-start">
                        <div class="w-12 h-12 rounded-xl bg-gold-100 flex items-center justify-center text-2xl flex-shrink-0">{{ $item['icon'] }}</div>
                        <div>
                            <h4 class="font-semibold text-gray-800">{{ $item['title'] }}</h4>
                            <p class="text-gray-500 text-sm">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="relative">
                <div class="img-placeholder rounded-2xl h-96 overflow-hidden">
                    <div class="text-center text-gold-600">
                        <div class="text-8xl mb-4">🕌</div>
                        <p class="text-xl font-bold">Masjidil Haram</p>
                        <p>Makkah Al-Mukarramah</p>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 bg-white rounded-xl shadow-xl p-4 text-center">
                    <div class="text-3xl font-bold text-gold-600">15+</div>
                    <div class="text-sm text-gray-500">Tahun Melayani</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Pembimbing --}}
@if($pembimbing->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="badge-gold inline-block mb-3">Tim Kami</div>
            <h2 class="section-title">Pembimbing Profesional</h2>
            <div class="section-gold-line mx-auto"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($pembimbing as $p)
            <div class="text-center card p-6">
                <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-4 border-4 border-gold-200">
                    <img src="{{ $p->thumbnail_url }}" alt="{{ $p->nama }}" class="w-full h-full object-cover">
                </div>
                <h4 class="font-bold text-gray-800">{{ $p->nama_lengkap }}</h4>
                <p class="text-gold-600 text-sm">{{ $p->jabatan }}</p>
                <p class="text-gray-400 text-xs mt-1">{{ $p->pengalaman_tahun }} tahun pengalaman</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('pembimbing.index') }}" class="btn-gold-outline">Lihat Semua Pembimbing</a>
        </div>
    </div>
</section>
@endif

{{-- Testimoni --}}
@if($testimoni->count() > 0)
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="badge-gold inline-block mb-3">Kata Mereka</div>
            <h2 class="section-title">Testimoni Jamaah</h2>
            <div class="section-gold-line mx-auto"></div>
        </div>
        <div class="swiper testimoni-swiper pb-10">
            <div class="swiper-wrapper">
                @foreach($testimoni as $t)
                <div class="swiper-slide">
                    <div class="card-gold h-full p-6">
                        <div class="text-gold-400 text-xl mb-3">{{ str_repeat('★', $t->rating) }}</div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-4">"{{ $t->isi }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-gold-200">
                                <img src="{{ $t->foto_url }}" alt="{{ $t->nama }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800 text-sm">{{ $t->nama }}</div>
                                <div class="text-xs text-gray-400">{{ $t->asal_kota }}{{ $t->paket ? ' · ' . $t->paket->jenis_label : '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="testimoni-pagination mt-6 text-center"></div>
        </div>
    </div>
</section>
@endif

{{-- Artikel Terbaru --}}
@if($artikelTerbaru->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <div class="badge-gold inline-block mb-3">Info & Tips</div>
            <h2 class="section-title">Artikel Terbaru</h2>
            <div class="section-gold-line mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($artikelTerbaru as $artikel)
            <div class="card group">
                <div class="overflow-hidden h-48">
                    <img src="{{ $artikel->thumbnail_url }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-5">
                    <span class="badge-gold mb-2 inline-block">{{ $artikel->kategori_label }}</span>
                    <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $artikel->judul }}</h3>
                    <p class="text-gray-500 text-sm line-clamp-3 mb-4">{{ $artikel->ringkasan }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400">{{ $artikel->published_at?->format('d M Y') }}</span>
                        <a href="{{ route('artikel.show', $artikel->slug) }}" class="text-gold-600 font-semibold text-sm hover:text-gold-700">Baca →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('artikel.index') }}" class="btn-gold-outline">Lihat Semua Artikel</a>
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-16 bg-gradient-to-r from-gold-700 to-gold-900 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Berangkat Ibadah?</h2>
        <p class="text-gold-200 text-lg mb-8 max-w-xl mx-auto">Konsultasikan rencana perjalanan ibadah Anda dengan tim kami. Gratis, tanpa biaya apapun.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('paket.index') }}" class="btn-white">Lihat Paket</a>
            <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-500 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-green-600 transition flex items-center gap-2">
                💬 Chat WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection
