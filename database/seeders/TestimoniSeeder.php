<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        $testimonis = [
            ['nama' => 'Bapak Hendra Kusuma', 'asal_kota' => 'Jakarta', 'rating' => 5, 'tahun' => 2024, 'is_featured' => true, 'isi' => 'Alhamdulillah, perjalanan umrah bersama ibadah-Kuy sungguh berkesan. Pembimbingnya sabar dan profesional, hotel dekat Masjidil Haram, dan semua fasilitas terpenuhi dengan baik. Sangat rekomendasikan!'],
            ['nama' => 'Ibu Sari Dewi', 'asal_kota' => 'Surabaya', 'rating' => 5, 'tahun' => 2024, 'is_featured' => true, 'isi' => 'Ini adalah pengalaman umrah pertama saya, dan saya sangat puas dengan pelayanan ibadah-Kuy. Mulai dari proses pendaftaran hingga kepulangan, semuanya terorganisir dengan sangat baik.'],
            ['nama' => 'Bapak & Ibu Santoso', 'asal_kota' => 'Bandung', 'rating' => 5, 'tahun' => 2023, 'is_featured' => true, 'isi' => 'Kami berangkat bersama keluarga, 4 orang. Pelayanannya sangat memuaskan, pembimbing sangat perhatian kepada semua jamaah. Insya Allah akan berangkat lagi bersama ibadah-Kuy.'],
            ['nama' => 'Ibu Rahma Aulia', 'asal_kota' => 'Medan', 'rating' => 4, 'tahun' => 2023, 'is_featured' => false, 'isi' => 'Perjalanan umrah yang sangat berkesan. Manasik sebelum keberangkatan sangat membantu saya yang baru pertama kali umrah. Terima kasih ibadah-Kuy!'],
            ['nama' => 'Bapak Darmawan', 'asal_kota' => 'Yogyakarta', 'rating' => 5, 'tahun' => 2024, 'is_featured' => true, 'isi' => 'Sudah 3 kali umrah bersama ibadah-Kuy dan selalu puas. Konsisten dalam pelayanan dan harga yang kompetitif. Pembimbing selalu siap membantu kapanpun dibutuhkan.'],
            ['nama' => 'Ibu Fatimah Zahra', 'asal_kota' => 'Makassar', 'rating' => 5, 'tahun' => 2023, 'is_featured' => false, 'isi' => 'Paket Umrah Ramadan yang sangat spesial. Menjalankan ibadah di bulan Ramadan di Tanah Suci adalah pengalaman yang tidak ternilai. Terima kasih tim ibadah-Kuy.'],
        ];

        foreach ($testimonis as $t) {
            Testimoni::firstOrCreate(['nama' => $t['nama']], $t + ['is_aktif' => true]);
        }
    }
}
