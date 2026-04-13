<?php

namespace Database\Seeders;

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
