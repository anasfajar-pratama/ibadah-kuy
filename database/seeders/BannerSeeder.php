<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            ['judul' => 'Wujudkan Impian Ibadah ke Tanah Suci', 'subjudul' => 'Paket haji dan umrah terpercaya dengan fasilitas terbaik. Daftar sekarang dan dapatkan konsultasi gratis!', 'link' => '/paket', 'teks_tombol' => 'Lihat Paket', 'gambar' => '', 'is_aktif' => true, 'urutan' => 1],
            ['judul' => 'Umrah Ramadan - Pengalaman Spiritual Tak Terlupakan', 'subjudul' => 'Rasakan keistimewaan ibadah di bulan suci Ramadan bersama ibadah-Kuy. Kuota terbatas!', 'link' => '/paket?jenis=umrah_ramadan', 'teks_tombol' => 'Daftar Sekarang', 'gambar' => '', 'is_aktif' => true, 'urutan' => 2],
            ['judul' => 'Haji Plus - Antrian Lebih Cepat, Fasilitas Premium', 'subjudul' => 'Daftarkan diri Anda sekarang dan wujudkan rukun Islam kelima dengan pelayanan VIP.', 'link' => '/paket?jenis=haji_plus', 'teks_tombol' => 'Info Selengkapnya', 'gambar' => '', 'is_aktif' => true, 'urutan' => 3],
        ];

        foreach ($banners as $banner) {
            Banner::firstOrCreate(['judul' => $banner['judul']], $banner);
        }
    }
}
