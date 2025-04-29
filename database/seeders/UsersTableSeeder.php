<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Budi Utomo',
                'email' => 'dokterbudiutomo@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('budi123'),
                'alamat' => 'Ungaran',
                'no_hp' => '081234567890',
                'role' => 'dokter',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rina Suryani',
                'email' => 'rinasur@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('rina123'),
                'alamat' => 'Bojonegoro',
                'no_hp' => '082145673210',
                'role' => 'pasien',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fadli Syauki',
                'email' => 'dokterfadlisyauki@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('fadli123'),
                'alamat' => 'Bandungan',
                'no_hp' => '081312345678',
                'role' => 'dokter',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dhani Setiabudi',
                'email' => 'dhaniset@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('dhani123'),
                'alamat' => 'Kalibanteng',
                'no_hp' => '085212345678',
                'role' => 'pasien',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dita Utami',
                'email' => 'dokterditautami@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('dita123'),
                'alamat' => 'PucangGading',
                'no_hp' => '081987654321',
                'role' => 'dokter',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
