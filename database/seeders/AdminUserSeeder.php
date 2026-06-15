<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ibadahkuy.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@ibadahkuy.com',
                'password' => Hash::make('Admin123!'),
            ]
        );
    }
}
