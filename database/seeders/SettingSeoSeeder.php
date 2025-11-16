<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SettingSeo;

class SettingSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat satu baris data default jika belum ada
        SettingSeo::firstOrCreate(
            ['id' => 1], // Cari berdasarkan ID 1
            [
                'meta_title' => 'Judul Website Anda',
                'meta_description' => 'Deskripsi default website Anda.',
                'meta_keywords' => ['keyword1', 'keyword2'], 
                'robots' => ['index', 'follow'],
            ]
        );
    }
}
