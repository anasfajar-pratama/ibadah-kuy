<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'nama_perusahaan',  'value' => 'ibadah-Kuy',                    'group' => 'umum',   'label' => 'Nama Perusahaan',  'type' => 'text'],
            ['key' => 'tagline',           'value' => 'Travel Haji & Umrah Terpercaya', 'group' => 'umum',   'label' => 'Tagline',          'type' => 'text'],
            ['key' => 'alamat',            'value' => 'Jl. Contoh No. 123, Jakarta Selatan 12345', 'group' => 'kontak', 'label' => 'Alamat', 'type' => 'textarea'],
            ['key' => 'telepon',           'value' => '+62 812-3456-7890',              'group' => 'kontak', 'label' => 'Telepon',          'type' => 'text'],
            ['key' => 'email',             'value' => 'info@ibadahkuy.com',             'group' => 'kontak', 'label' => 'Email',            'type' => 'text'],
            ['key' => 'whatsapp',          'value' => '6281234567890',                  'group' => 'kontak', 'label' => 'WhatsApp',         'type' => 'text'],
            ['key' => 'instagram',         'value' => 'https://instagram.com/ibadahkuy','group' => 'sosmed', 'label' => 'Instagram',        'type' => 'text'],
            ['key' => 'facebook',          'value' => 'https://facebook.com/ibadahkuy', 'group' => 'sosmed', 'label' => 'Facebook',         'type' => 'text'],
            ['key' => 'youtube',           'value' => 'https://youtube.com/@ibadahkuy', 'group' => 'sosmed', 'label' => 'YouTube',          'type' => 'text'],
            ['key' => 'no_izin_ppiu',      'value' => 'XXX/PPIU/2024',                 'group' => 'legalitas', 'label' => 'No. Izin PPIU', 'type' => 'text'],
            ['key' => 'tahun_berdiri',     'value' => '2010',                           'group' => 'umum',   'label' => 'Tahun Berdiri',    'type' => 'text'],
        ];

        foreach ($settings as $s) {
            Pengaturan::firstOrCreate(['key' => $s['key']], $s);
        }
    }
}
