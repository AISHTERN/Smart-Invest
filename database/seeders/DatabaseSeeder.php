<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin dummy
        User::create([

            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'), // login pakai: admin@example.com / password
            'role' => 'admin',
        ]);

        // Panggil seeder kategori & investment
        $this->call([
            CategorySeeder::class,
        ]);
    }
}
