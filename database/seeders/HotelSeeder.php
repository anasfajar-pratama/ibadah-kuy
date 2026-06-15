<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            ['nama' => 'Zam-Zam Tower', 'lokasi' => 'makkah', 'bintang' => 5, 'jarak_ke_masjid' => '50 meter', 'deskripsi' => 'Hotel mewah tepat di samping Masjidil Haram dengan pemandangan Ka\'bah yang menakjubkan.', 'fasilitas' => [['item' => 'Kolam Renang'], ['item' => 'Restoran Internasional'], ['item' => 'Pusat Kebugaran'], ['item' => 'Spa'], ['item' => 'WiFi Gratis'], ['item' => 'Room Service 24 Jam']]],
            ['nama' => 'Hilton Towers Makkah', 'lokasi' => 'makkah', 'bintang' => 5, 'jarak_ke_masjid' => '200 meter', 'deskripsi' => 'Salah satu hotel terbaik di Makkah dengan fasilitas lengkap dan pelayanan premium.', 'fasilitas' => [['item' => 'Kolam Renang'], ['item' => 'Multiple Restaurant'], ['item' => 'Business Center'], ['item' => 'WiFi Gratis'], ['item' => 'Concierge Service']]],
            ['nama' => 'Dar Al-Tawhid Intercontinental', 'lokasi' => 'makkah', 'bintang' => 5, 'jarak_ke_masjid' => '100 meter', 'deskripsi' => 'Hotel premium dengan lokasi strategis dan pemandangan Masjidil Haram yang langsung terlihat dari kamar.', 'fasilitas' => [['item' => 'Restoran Premium'], ['item' => 'Shopping Arcade'], ['item' => 'Prayer Room'], ['item' => 'WiFi Gratis'], ['item' => 'Airport Transfer']]],
            ['nama' => 'Movenpick Madinah', 'lokasi' => 'madinah', 'bintang' => 5, 'jarak_ke_masjid' => '100 meter', 'deskripsi' => 'Hotel mewah di Madinah dengan akses mudah ke Masjid Nabawi dan fasilitas bintang lima.', 'fasilitas' => [['item' => 'Kolam Renang'], ['item' => 'Restoran Internasional'], ['item' => 'Spa'], ['item' => 'WiFi Gratis'], ['item' => 'Shuttle ke Masjid']]],
            ['nama' => 'Pullman Madinah', 'lokasi' => 'madinah', 'bintang' => 5, 'jarak_ke_masjid' => '150 meter', 'deskripsi' => 'Hotel modern berstandar internasional dengan nuansa Islami yang kental di Madinah.', 'fasilitas' => [['item' => 'Kolam Renang'], ['item' => 'Sky Lounge'], ['item' => 'Halal Restaurant'], ['item' => 'WiFi Gratis'], ['item' => 'Concierge']]],
            ['nama' => 'Al-Ansar Madinah', 'lokasi' => 'madinah', 'bintang' => 4, 'jarak_ke_masjid' => '500 meter', 'deskripsi' => 'Hotel bintang empat dengan harga terjangkau namun tetap nyaman di Madinah.', 'fasilitas' => [['item' => 'Restoran Halal'], ['item' => 'WiFi Gratis'], ['item' => 'Shuttle ke Masjid'], ['item' => 'Laundry Service']]],
        ];

        foreach ($hotels as $hotel) {
            Hotel::firstOrCreate(['slug' => \Illuminate\Support\Str::slug($hotel['nama'])], $hotel + ['is_aktif' => true]);
        }
    }
}
