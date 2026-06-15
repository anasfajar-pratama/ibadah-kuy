<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'ibadah-Kuy - Travel Haji & Umrah Terpercaya')">
    <title>@yield('title', 'ibadah-Kuy') - Travel Haji & Umrah</title>
    @vite(['resources/css/public.css', 'resources/js/public.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-jakarta bg-white text-gray-800">

    <!-- Top Bar -->
    <div class="bg-gold-900 text-gold-100 text-sm py-2">
        <div class="container mx-auto px-4 flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <a href="tel:+6281234567890" class="flex items-center gap-1 hover:text-white transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                    +62 812-3456-7890
                </a>
                <a href="mailto:info@ibadahkuy.com" class="flex items-center gap-1 hover:text-white transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                    info@ibadahkuy.com
                </a>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="hover:text-white transition">Instagram</a>
                <a href="#" class="hover:text-white transition">WhatsApp</a>
                <a href="#" class="hover:text-white transition">YouTube</a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ open: false }">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-gold-500 flex items-center justify-center">
                        <span class="text-white font-bold text-lg">iK</span>
                    </div>
                    <div>
                        <span class="font-bold text-xl text-gold-700">ibadah-Kuy</span>
                        <p class="text-xs text-gray-500 leading-none">Travel Haji & Umrah</p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                    <div class="relative group">
                        <button class="nav-link flex items-center gap-1">
                            Paket
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute top-full left-0 bg-white shadow-xl rounded-lg py-2 w-52 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gold-100">
                            <a href="{{ route('paket.index') }}?jenis=haji" class="dropdown-item">Paket Haji</a>
                            <a href="{{ route('paket.index') }}?jenis=umrah" class="dropdown-item">Paket Umrah</a>
                            <a href="{{ route('paket.index') }}" class="dropdown-item">Semua Paket</a>
                        </div>
                    </div>
                    <a href="{{ route('hotel.index') }}" class="nav-link {{ request()->routeIs('hotel.*') ? 'active' : '' }}">Hotel</a>
                    <a href="{{ route('pembimbing.index') }}" class="nav-link {{ request()->routeIs('pembimbing.*') ? 'active' : '' }}">Pembimbing</a>
                    <a href="{{ route('galeri.index') }}" class="nav-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}">Galeri</a>
                    <a href="{{ route('artikel.index') }}" class="nav-link {{ request()->routeIs('artikel.*') ? 'active' : '' }}">Artikel</a>
                    <a href="{{ route('kontak.index') }}" class="nav-link {{ request()->routeIs('kontak.*') ? 'active' : '' }}">Kontak</a>
                </div>

                <!-- CTA -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn-gold text-sm">
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Hamburger -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg hover:bg-gold-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-transition class="md:hidden py-4 border-t border-gold-100">
                <div class="flex flex-col gap-1">
                    <a href="{{ route('home') }}" class="mobile-nav-link">Beranda</a>
                    <a href="{{ route('paket.index') }}" class="mobile-nav-link">Paket Haji & Umrah</a>
                    <a href="{{ route('hotel.index') }}" class="mobile-nav-link">Hotel</a>
                    <a href="{{ route('pembimbing.index') }}" class="mobile-nav-link">Pembimbing</a>
                    <a href="{{ route('galeri.index') }}" class="mobile-nav-link">Galeri</a>
                    <a href="{{ route('artikel.index') }}" class="mobile-nav-link">Artikel</a>
                    <a href="{{ route('kontak.index') }}" class="mobile-nav-link">Kontak</a>
                    <a href="https://wa.me/6281234567890" class="btn-gold mt-2 text-center">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Message -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 mx-4 mt-4 rounded" x-data="{ show: true }" x-show="show">
        <div class="flex justify-between items-center">
            <p class="text-green-700">{{ session('success') }}</p>
            <button @click="show = false" class="text-green-400 hover:text-green-600">✕</button>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gold-900 text-gold-100 mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gold-500 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">iK</span>
                        </div>
                        <span class="font-bold text-xl text-white">ibadah-Kuy</span>
                    </div>
                    <p class="text-gold-300 text-sm leading-relaxed">
                        Travel haji dan umrah terpercaya. Melayani dengan sepenuh hati untuk perjalanan ibadah yang berkesan.
                    </p>
                    <div class="flex gap-3 mt-4">
                        <a href="#" class="w-9 h-9 rounded-full bg-gold-700 flex items-center justify-center hover:bg-gold-500 transition text-sm font-bold">IG</a>
                        <a href="#" class="w-9 h-9 rounded-full bg-gold-700 flex items-center justify-center hover:bg-gold-500 transition text-sm font-bold">WA</a>
                        <a href="#" class="w-9 h-9 rounded-full bg-gold-700 flex items-center justify-center hover:bg-gold-500 transition text-sm font-bold">YT</a>
                        <a href="#" class="w-9 h-9 rounded-full bg-gold-700 flex items-center justify-center hover:bg-gold-500 transition text-sm font-bold">FB</a>
                    </div>
                </div>

                <!-- Paket -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Paket Perjalanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('paket.index') }}?jenis=haji_reguler" class="text-gold-300 hover:text-white transition">Haji Reguler</a></li>
                        <li><a href="{{ route('paket.index') }}?jenis=haji_plus" class="text-gold-300 hover:text-white transition">Haji Plus</a></li>
                        <li><a href="{{ route('paket.index') }}?jenis=umrah_reguler" class="text-gold-300 hover:text-white transition">Umrah Reguler</a></li>
                        <li><a href="{{ route('paket.index') }}?jenis=umrah_plus" class="text-gold-300 hover:text-white transition">Umrah Plus</a></li>
                        <li><a href="{{ route('paket.index') }}?jenis=umrah_ramadan" class="text-gold-300 hover:text-white transition">Umrah Ramadan</a></li>
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Informasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('artikel.index') }}" class="text-gold-300 hover:text-white transition">Artikel & Blog</a></li>
                        <li><a href="{{ route('galeri.index') }}" class="text-gold-300 hover:text-white transition">Galeri Foto</a></li>
                        <li><a href="{{ route('testimoni.index') }}" class="text-gold-300 hover:text-white transition">Testimoni</a></li>
                        <li><a href="{{ route('faq.index') }}" class="text-gold-300 hover:text-white transition">FAQ</a></li>
                        <li><a href="{{ route('kontak.index') }}" class="text-gold-300 hover:text-white transition">Kontak Kami</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm text-gold-300">
                        <li class="flex gap-2"><span>📍</span> Jl. Contoh No. 123, Jakarta Selatan</li>
                        <li class="flex gap-2"><span>📞</span> +62 812-3456-7890</li>
                        <li class="flex gap-2"><span>✉️</span> info@ibadahkuy.com</li>
                        <li class="flex gap-2"><span>🕐</span> Senin – Sabtu: 08.00 – 17.00</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gold-700 mt-8 pt-6 flex flex-wrap justify-between items-center gap-4 text-sm text-gold-400">
                <p>© {{ date('Y') }} ibadah-Kuy. Semua hak dilindungi.</p>
                <p>Izin PPIU No. XXX/PPIU/2024</p>
            </div>
        </div>
    </footer>

</body>
</html>
