<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikels = [
            [
                'judul' => '7 Tips Persiapan Fisik Sebelum Berangkat Umrah',
                'kategori' => 'tips', 'penulis' => 'Tim ibadah-Kuy', 'status' => 'publish',
                'published_at' => now()->subDays(5),
                'ringkasan' => 'Persiapan fisik yang matang sangat penting sebelum berangkat umrah. Berikut tips dari tim ibadah-Kuy untuk menjaga stamina Anda.',
                'konten' => '<p>Ibadah umrah membutuhkan stamina fisik yang baik karena Anda akan banyak berjalan dan berada di tempat terbuka. Berikut 7 tips persiapan fisik yang wajib Anda lakukan:</p><h3>1. Latihan Jalan Kaki</h3><p>Mulai latihan jalan kaki minimal 3 km per hari, 2-3 bulan sebelum keberangkatan.</p><h3>2. Jaga Pola Makan</h3><p>Konsumsi makanan bergizi dan hindari makanan yang dapat menyebabkan gangguan pencernaan.</p><h3>3. Cukup Istirahat</h3><p>Pastikan tidur minimal 7-8 jam per hari untuk menjaga daya tahan tubuh.</p>',
                'views' => 245,
            ],
            [
                'judul' => 'Panduan Lengkap Visa Umrah 2024: Syarat dan Prosedur',
                'kategori' => 'info_visa', 'penulis' => 'Tim ibadah-Kuy', 'status' => 'publish',
                'published_at' => now()->subDays(10),
                'ringkasan' => 'Simak panduan lengkap pengajuan visa umrah 2024. Kami jelaskan semua syarat dokumen dan prosedur yang perlu Anda ketahui.',
                'konten' => '<p>Visa umrah adalah dokumen wajib yang harus dimiliki setiap jamaah yang ingin melaksanakan ibadah umrah ke Arab Saudi. Berikut panduan lengkapnya:</p><h3>Syarat Dokumen</h3><ul><li>Paspor berlaku minimal 6 bulan</li><li>Foto terbaru 3x4 dan 4x6</li><li>Kartu Keluarga</li><li>Buku nikah/akte lahir</li></ul>',
                'views' => 389,
            ],
            [
                'judul' => 'Amalan Sunnah yang Dianjurkan Saat Berada di Tanah Suci',
                'kategori' => 'panduan', 'penulis' => 'Ust. Ahmad Fauzi', 'status' => 'publish',
                'published_at' => now()->subDays(15),
                'ringkasan' => 'Selain ibadah wajib, ada banyak amalan sunnah yang sangat dianjurkan saat berada di Makkah dan Madinah.',
                'konten' => '<p>Keberadaan kita di Tanah Suci adalah kesempatan emas untuk memperbanyak amal ibadah. Berikut amalan sunnah yang dianjurkan:</p><h3>Di Makkah</h3><ul><li>Tawaf sunnah sebanyak mungkin</li><li>Minum air zamzam sambil berdiri menghadap Ka\'bah</li><li>Sholat di Masjidil Haram</li></ul>',
                'views' => 512,
            ],
        ];

        foreach ($artikels as $artikel) {
            Artikel::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($artikel['judul'])],
                $artikel
            );
        }
    }
}
