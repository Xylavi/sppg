<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin_sppg',
            'password' => Hash::make('Admin@SPPG2026'),
            'role' => 'admin',
        ]);
        User::create([
            'username' => 'gizi_sppg',
            'password' => Hash::make('Gizi@MBG2026'),
            'role' => 'petugas_gizi',
        ]);
        User::create([
            'username' => 'pengaduan_sppg',
            'password' => Hash::make('Aduan@MBG2026'),
            'role' => 'petugas_pengaduan',
        ]);
    }
}
