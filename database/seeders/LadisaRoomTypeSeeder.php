<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LadisaRoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\LadisaRoomType::create([
            'name' => 'Family Packages',
            'description' => 'Paket kamar khusus untuk keluarga dengan fasilitas lengkap',
        ]);

        \App\Models\LadisaRoomType::create([
            'name' => 'In-Team Package',
            'description' => 'Paket kamar untuk tim dengan ruang meeting dan fasilitas kerja',
        ]);

        \App\Models\LadisaRoomType::create([
            'name' => 'Perfect Meeting Package',
            'description' => 'Paket kamar dengan ruang meeting yang sempurna untuk acara bisnis',
        ]);

        \App\Models\LadisaRoomType::create([
            'name' => 'Vocation Deals Hemat Ramai 1',
            'description' => 'Paket liburan hemat untuk rombongan dengan fasilitas standar',
        ]);

        \App\Models\LadisaRoomType::create([
            'name' => 'Vocation Deals Hemat Ramai 2',
            'description' => 'Paket liburan hemat untuk rombongan dengan fasilitas premium',
        ]);
    }
}
