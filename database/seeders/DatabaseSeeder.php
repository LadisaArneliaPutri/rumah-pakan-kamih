<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345'), // ✅ password: 12345
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User biasa
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('12345'), // ✅ password: 12345
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seeder lainnya
        $this->call([
            LadisaRoomTypeSeeder::class,
        ]);
    }
}
