<?php

namespace Database\Seeders;

use App\Models\Paket;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        $pakets = [
            [
                'nama' => 'Umrah Reguler Ekonomis', 'jenis' => 'umrah_reguler',
                'deskripsi' => 'Paket umrah hemat dengan fasilitas lengkap. Cocok untuk jamaah yang ingin beribadah dengan nyaman dan terjangkau.',
                'harga' => 25000000, 'durasi_hari' => 9, 'kuota' => 40, 'sisa_kursi' => 25,
                'maskapai' => 'Saudi Airlines', 'kelas_penerbangan' => 'Economy',
                'hotel_makkah' => 'Hotel Zam-Zam Tower', 'bintang_hotel_makkah' => '3',
                'hotel_madinah' => 'Hotel Al-Ansar', 'bintang_hotel_madinah' => '3',
                'fasilitas' => [['item' => 'Tiket Pesawat PP'], ['item' => 'Visa Umrah'], ['item' => 'Hotel Bintang 3'], ['item' => 'Makan 3x Sehari'], ['item' => 'Pembimbing Berpengalaman'], ['item' => 'Transportasi AC'], ['item' => 'Perlengkapan Umrah']],
                'is_featured' => true, 'is_aktif' => true, 'urutan' => 1,
            ],
            [
                'nama' => 'Umrah Plus Premium', 'jenis' => 'umrah_plus',
                'deskripsi' => 'Paket umrah premium dengan hotel bintang 5 dekat Masjidil Haram. Pengalaman ibadah yang mewah dan berkesan.',
                'harga' => 45000000, 'durasi_hari' => 12, 'kuota' => 30, 'sisa_kursi' => 12,
                'maskapai' => 'Emirates', 'kelas_penerbangan' => 'Business',
                'hotel_makkah' => 'Hotel Swissotel Makkah', 'bintang_hotel_makkah' => '5',
                'hotel_madinah' => 'Hotel Movenpick Madinah', 'bintang_hotel_madinah' => '5',
                'fasilitas' => [['item' => 'Tiket Pesawat Business Class'], ['item' => 'Visa Umrah'], ['item' => 'Hotel Bintang 5'], ['item' => 'Makan 3x Sehari'], ['item' => 'Pembimbing Senior'], ['item' => 'City Tour Makkah-Madinah'], ['item' => 'Perlengkapan Premium'], ['item' => 'Asuransi Perjalanan']],
                'is_featured' => true, 'is_aktif' => true, 'urutan' => 2,
            ],
            [
                'nama' => 'Umrah Ramadan Spesial', 'jenis' => 'umrah_ramadan',
                'deskripsi' => 'Rasakan keistimewaan ibadah umrah di bulan suci Ramadan. Paket lengkap dengan pengalaman spiritual yang luar biasa.',
                'harga' => 38000000, 'durasi_hari' => 15, 'kuota' => 35, 'sisa_kursi' => 8,
                'maskapai' => 'Garuda Indonesia', 'kelas_penerbangan' => 'Economy',
                'hotel_makkah' => 'Hotel Hilton Makkah', 'bintang_hotel_makkah' => '5',
                'hotel_madinah' => 'Hotel Pullman Madinah', 'bintang_hotel_madinah' => '4',
                'fasilitas' => [['item' => 'Tiket Pesawat PP'], ['item' => 'Visa Umrah'], ['item' => 'Hotel Bintang 4-5'], ['item' => 'Sahur & Buka Puasa'], ['item' => 'Tarawih Berjamaah'], ['item' => 'Tausiyah Ramadan'], ['item' => 'Pembimbing Senior']],
                'is_featured' => true, 'is_aktif' => true, 'urutan' => 3,
            ],
            [
                'nama' => 'Haji Reguler 2025', 'jenis' => 'haji_reguler',
                'deskripsi' => 'Paket haji reguler resmi Kementerian Agama RI. Proses pendaftaran porsi resmi dengan fasilitas standar pemerintah.',
                'harga' => 85000000, 'durasi_hari' => 40, 'kuota' => 50, 'sisa_kursi' => 20,
                'maskapai' => 'Saudi Airlines', 'kelas_penerbangan' => 'Economy',
                'hotel_makkah' => 'Hotel Hilton Towers', 'bintang_hotel_makkah' => '4',
                'hotel_madinah' => 'Hotel Anwar Madinah', 'bintang_hotel_madinah' => '4',
                'fasilitas' => [['item' => 'Tiket Pesawat PP'], ['item' => 'Visa Haji'], ['item' => 'Hotel Bintang 4'], ['item' => 'Makan 3x Sehari'], ['item' => 'Pembimbing Senior'], ['item' => 'Manasik Haji'], ['item' => 'Perlengkapan Haji Lengkap'], ['item' => 'Asuransi Jiwa']],
                'is_featured' => true, 'is_aktif' => true, 'urutan' => 4,
            ],
            [
                'nama' => 'Haji Plus ONH Plus', 'jenis' => 'haji_plus',
                'deskripsi' => 'Paket haji plus dengan antrian lebih cepat. Hotel premium, pelayanan VIP, dan fasilitas eksklusif untuk jamaah.',
                'harga' => 150000000, 'durasi_hari' => 30, 'kuota' => 20, 'sisa_kursi' => 5,
                'maskapai' => 'Garuda Indonesia', 'kelas_penerbangan' => 'Business',
                'hotel_makkah' => 'Hotel Zam-Zam Pullman', 'bintang_hotel_makkah' => '5',
                'hotel_madinah' => 'Hotel Movenpick', 'bintang_hotel_madinah' => '5',
                'fasilitas' => [['item' => 'Tiket Pesawat Business Class'], ['item' => 'Visa Haji Plus'], ['item' => 'Hotel Bintang 5'], ['item' => 'Full Board Meals'], ['item' => 'Pembimbing VIP'], ['item' => 'City Tour'], ['item' => 'Perlengkapan Premium'], ['item' => 'Asuransi Komprehensif'], ['item' => 'Muthawwif Pribadi']],
                'is_featured' => true, 'is_aktif' => true, 'urutan' => 5,
            ],
            [
                'nama' => 'Umrah Keluarga Custom', 'jenis' => 'umrah_custom',
                'deskripsi' => 'Paket umrah khusus untuk keluarga atau rombongan. Jadwal fleksibel sesuai kebutuhan Anda.',
                'harga' => 32000000, 'durasi_hari' => 10, 'kuota' => 20, 'sisa_kursi' => 15,
                'maskapai' => 'Batik Air', 'kelas_penerbangan' => 'Economy',
                'hotel_makkah' => 'Hotel Dar Al-Tawhid', 'bintang_hotel_makkah' => '4',
                'hotel_madinah' => 'Hotel Al-Haram', 'bintang_hotel_madinah' => '3',
                'fasilitas' => [['item' => 'Tiket Pesawat PP'], ['item' => 'Visa Umrah'], ['item' => 'Hotel Pilihan'], ['item' => 'Makan 3x Sehari'], ['item' => 'Pembimbing Keluarga'], ['item' => 'Jadwal Fleksibel']],
                'is_featured' => false, 'is_aktif' => true, 'urutan' => 6,
            ],
        ];

        foreach ($pakets as $data) {
            $paket = Paket::firstOrCreate(['slug' => \Illuminate\Support\Str::slug($data['nama'])], $data);

            // Buat jadwal contoh
            Jadwal::firstOrCreate(
                ['paket_id' => $paket->id, 'tanggal_berangkat' => now()->addMonths(2)->format('Y-m-d')],
                [
                    'paket_id' => $paket->id,
                    'tanggal_berangkat' => now()->addMonths(2)->format('Y-m-d'),
                    'tanggal_kembali' => now()->addMonths(2)->addDays($data['durasi_hari'])->format('Y-m-d'),
                    'bandara_keberangkatan' => 'Bandara Soekarno-Hatta, Jakarta',
                    'maskapai' => $data['maskapai'],
                    'no_penerbangan' => 'XX-' . rand(100, 999),
                    'kuota' => $data['kuota'],
                    'sisa_kursi' => $data['sisa_kursi'],
                    'status' => 'tersedia',
                ]
            );
        }
    }
}
