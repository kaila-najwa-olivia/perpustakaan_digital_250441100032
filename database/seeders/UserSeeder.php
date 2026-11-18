<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Perpustakaan',
                'password' => 'password',
                'role' => 'Admin',
            ]
        );
        $admin->syncRoles(['admin']);

        // 2. Akun Petugas
        $petugas = User::firstOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name' => 'Petugas Perpustakaan',
                'password' => 'password',
                'role' => 'Petugas',
            ]
        );
        $petugas->syncRoles(['petugas']);

        // 3. Akun Siswa
        $siswa = User::firstOrCreate(
            ['email' => 'siswa@gmail.com'],
            [
                'name' => 'Siswa Perpustakaan',
                'password' => 'password',
                'role' => 'Siswa',
            ]
        );
        $siswa->syncRoles(['siswa']);

        // Pastikan akun siswa memiliki data di tabel anggotas
        Anggota::firstOrCreate(
            ['user_id' => $siswa->id],
            [
                'nama' => $siswa->name,
                'email' => $siswa->email,
                'no_telepon' => '081234567890',
            ]
        );
    }
}
