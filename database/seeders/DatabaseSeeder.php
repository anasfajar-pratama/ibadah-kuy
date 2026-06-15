<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            PengaturanSeeder::class,
            PaketSeeder::class,
            HotelSeeder::class,
            PembimbingSeeder::class,
            ArtikelSeeder::class,
            TestimoniSeeder::class,
            FaqSeeder::class,
            BannerSeeder::class,
            GaleriSeeder::class,
        ]);
    }
}
