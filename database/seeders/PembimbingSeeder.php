<?php

namespace Database\Seeders;

use App\Models\Pembimbing;
use Illuminate\Database\Seeder;

class PembimbingSeeder extends Seeder
{
    public function run(): void
    {
        $pembimbings = [
            ['nama' => 'Ahmad Fauzi', 'gelar' => 'Ust.', 'jabatan' => 'Ketua Pembimbing Senior', 'bio' => 'Ulama berpengalaman dengan keahlian manasik haji dan umrah selama lebih dari 20 tahun. Telah membimbing lebih dari 3.000 jamaah ke Tanah Suci.', 'keahlian' => 'Manasik Haji, Fiqih Ibadah, Tazkiyatun Nafs', 'pengalaman_tahun' => 20, 'total_jamaah' => 3000],
            ['nama' => 'Siti Aisyah', 'gelar' => 'Ustadzah', 'jabatan' => 'Pembimbing Jamaah Wanita', 'bio' => 'Pembimbing khusus untuk jamaah wanita dengan pendekatan yang penuh kasih sayang dan profesional.', 'keahlian' => 'Fikih Wanita, Adab & Doa, Kesehatan Jamaah', 'pengalaman_tahun' => 12, 'total_jamaah' => 1500],
            ['nama' => 'Muhammad Iqbal', 'gelar' => 'Dr.', 'jabatan' => 'Pembimbing & Konsultan Kesehatan', 'bio' => 'Dokter umum sekaligus pembimbing ibadah yang memastikan kesehatan jamaah selama perjalanan ke Tanah Suci.', 'keahlian' => 'Kesehatan Jamaah, Pertolongan Pertama, Manasik', 'pengalaman_tahun' => 8, 'total_jamaah' => 800],
            ['nama' => 'Abdullah Rahman', 'gelar' => 'Ust.', 'jabatan' => 'Pembimbing Muda Profesional', 'bio' => 'Pembimbing muda energik lulusan Universitas Islam Madinah dengan hafalan Al-Quran 30 juz.', 'keahlian' => 'Tahfidz Al-Quran, Sejarah Islam, Manasik', 'pengalaman_tahun' => 5, 'total_jamaah' => 400],
        ];

        foreach ($pembimbings as $p) {
            Pembimbing::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($p['nama'])],
                $p + ['is_aktif' => true]
            );
        }
    }
}
