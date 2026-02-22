<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Nutrition;
use App\Models\School;
use App\Models\Team;
use Illuminate\Database\Seeder;

class FrontendSeeder extends Seeder
{
    public function run(): void
    {
        $schoolA = School::create([
            'nama_sekolah' => 'SDN Kokrosono 01',
            'alamat' => 'Jl. Kokrosono No. 10, Semarang',
        ]);

        $schoolB = School::create([
            'nama_sekolah' => 'SMPN 05 Semarang',
            'alamat' => 'Jl. Menoreh Raya No. 21, Semarang',
        ]);

        $todayMenu = Menu::create([
            'nama_menu' => 'Nasi, Ayam Bakar, Tumis Bayam, Jeruk',
            'tanggal_menu' => today(),
            'school_id' => $schoolA->id,
            'foto_menu' => 'https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?q=80&w=1200&auto=format&fit=crop',
        ]);

        Nutrition::create([
            'menu_id' => $todayMenu->id,
            'energi' => 560,
            'protein' => 28,
            'lemak' => 16,
            'karbohidrat' => 75,
        ]);

        Menu::create([
            'nama_menu' => 'Nasi, Ikan Kembung, Sayur Asem, Pepaya',
            'tanggal_menu' => today()->subDays(1),
            'school_id' => $schoolB->id,
            'foto_menu' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1200&auto=format&fit=crop',
        ]);

        Team::insert([
            [
                'nama' => 'Dewi Lestari',
                'jabatan' => 'Koordinator SPPG',
                'foto' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rama Putra',
                'jabatan' => 'Petugas Gizi',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
