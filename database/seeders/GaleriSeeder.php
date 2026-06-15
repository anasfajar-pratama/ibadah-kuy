<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $galeris = [
            ['judul' => 'Tawaf di Masjidil Haram', 'kategori' => 'ibadah', 'lokasi' => 'Makkah', 'tahun' => 2024, 'is_featured' => true, 'deskripsi' => 'Jamaah ibadah-Kuy melaksanakan tawaf mengelilingi Ka\'bah.', 'gambar' => ''],
            ['judul' => 'Masjid Nabawi Madinah', 'kategori' => 'ibadah', 'lokasi' => 'Madinah', 'tahun' => 2024, 'is_featured' => true, 'deskripsi' => 'Suasana Masjid Nabawi yang agung di Madinah Al-Munawwarah.', 'gambar' => ''],
            ['judul' => 'Hotel Bintang 5 Makkah', 'kategori' => 'hotel', 'lokasi' => 'Makkah', 'tahun' => 2023, 'is_featured' => true, 'deskripsi' => 'Fasilitas kamar hotel bintang 5 dengan pemandangan Ka\'bah.', 'gambar' => ''],
            ['judul' => 'Bus Premium AC Berpendingin', 'kategori' => 'transportasi', 'lokasi' => 'Makkah', 'tahun' => 2024, 'is_featured' => false, 'deskripsi' => 'Armada bus premium dengan AC untuk kenyamanan jamaah.', 'gambar' => ''],
            ['judul' => 'Makan Bersama Jamaah', 'kategori' => 'kuliner', 'lokasi' => 'Madinah', 'tahun' => 2024, 'is_featured' => false, 'deskripsi' => 'Momen kebersamaan saat makan bersama di Madinah.', 'gambar' => ''],
            ['judul' => 'Ziarah Jabal Nur', 'kategori' => 'wisata', 'lokasi' => 'Makkah', 'tahun' => 2023, 'is_featured' => true, 'deskripsi' => 'Kunjungan ke Jabal Nur tempat turunnya wahyu pertama.', 'gambar' => ''],
        ];

        foreach ($galeris as $galeri) {
            Galeri::firstOrCreate(['judul' => $galeri['judul']], $galeri + ['is_aktif' => true]);
        }
    }
}
