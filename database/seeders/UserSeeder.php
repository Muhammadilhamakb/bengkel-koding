<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'andre',
                'no_hp' => '0987654321',
                'alamat' => 'semarang',
                'role' => 'pasien',
                'email' => 'andre@gmail.com',
                'password' => '123456',
            ],
            [
                'nama' => 'budi',
                'no_hp' => '0987654323',
                'alamat' => 'semarang',
                'role' => 'dokter',
                'email' => 'budi@gmail.com',
                'password' => '123456',
            ],
            [
                'nama' => 'cika',
                'no_hp' => '0987654324',
                'alamat' => 'semarang',
                'role' => 'pasien',
                'email' => 'cika@gmail.com',
                'password' => '123456',
            ],
            [
                'nama' => 'dika',
                'no_hp' => '0987654325',
                'alamat' => 'Jatingaleh',
                'role' => 'dokter',
                'email' => 'dika@gmail.com',
                'password' => '123456',
            ],
            [
                'nama' => 'admin',
                'no_hp' => '0987654332',
                'alamat' => 'Kota Semarang',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '123456',
            ],
        ];
        foreach ($data as $d) {
            User::create([
                'nama' => $d['nama'],
                'email' => $d['email'],
                'password' => $d['password'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
            ]);
        }
    }
}
