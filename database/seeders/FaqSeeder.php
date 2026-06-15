<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['kategori' => 'umum', 'pertanyaan' => 'Bagaimana cara mendaftar paket haji/umrah di ibadah-Kuy?', 'jawaban' => 'Anda dapat mendaftar melalui beberapa cara: (1) Datang langsung ke kantor kami, (2) Menghubungi kami via WhatsApp, atau (3) Mengisi formulir online. Tim kami akan menghubungi Anda dalam 1x24 jam.', 'urutan' => 1],
            ['kategori' => 'pembayaran', 'pertanyaan' => 'Berapa uang muka (DP) untuk mendaftar?', 'jawaban' => 'Uang muka minimal 30% dari total biaya paket. Sisa pembayaran dapat dilakukan secara cicilan sesuai kesepakatan. Kami menerima transfer bank dan beberapa metode pembayaran digital.', 'urutan' => 2],
            ['kategori' => 'dokumen', 'pertanyaan' => 'Dokumen apa saja yang diperlukan untuk mendaftar umrah?', 'jawaban' => 'Dokumen yang diperlukan: (1) Paspor berlaku minimal 6 bulan, (2) KTP, (3) Kartu Keluarga, (4) Buku Nikah (untuk suami-istri), (5) Akte Lahir (untuk anak), (6) Pas foto terbaru 3x4 dan 4x6 dengan background putih.', 'urutan' => 3],
            ['kategori' => 'umrah', 'pertanyaan' => 'Berapa lama durasi perjalanan umrah?', 'jawaban' => 'Durasi perjalanan umrah kami bervariasi dari 9 hari (ekonomis) hingga 15 hari (premium). Biasanya mencakup 5-7 hari di Makkah dan 3-5 hari di Madinah.', 'urutan' => 4],
            ['kategori' => 'haji', 'pertanyaan' => 'Apa perbedaan haji reguler, haji plus, dan haji furoda?', 'jawaban' => 'Haji Reguler: antrian porsi kemenag, waktu tunggu 20-30 tahun. Haji Plus/ONH Plus: antrian lebih cepat, fasilitas premium. Haji Furoda: visa undangan Saudi, bisa berangkat tahun ini tanpa antrian.', 'urutan' => 5],
            ['kategori' => 'umum', 'pertanyaan' => 'Apakah ibadah-Kuy sudah memiliki izin resmi?', 'jawaban' => 'Ya, ibadah-Kuy telah mendapatkan izin resmi PPIU (Penyelenggara Perjalanan Ibadah Umrah) dari Kementerian Agama RI. Nomor izin kami tercantum di semua dokumen resmi.', 'urutan' => 6],
            ['kategori' => 'pembayaran', 'pertanyaan' => 'Apakah biaya bisa dicicil?', 'jawaban' => 'Ya, kami menyediakan program cicilan tanpa bunga. Pembayaran dapat dilakukan bulanan sesuai kemampuan jamaah, dengan batas waktu pelunasan 1 bulan sebelum keberangkatan.', 'urutan' => 7],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['pertanyaan' => $faq['pertanyaan']], $faq + ['is_aktif' => true]);
        }
    }
}
