<?php

namespace Database\Seeders;

use App\Models\daftar_poliModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class daftarPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_pasien' => '1',
              
                'id_jadwal' => '1',
                'tanggal_daftar' => '2024-03-01',
                'no_antrean' => '2025-001',
            ],
            [
                'id_pasien' => '2',
               
                'id_jadwal' => '2',
                'tanggal_daftar' => '2024-03-01',
                'no_antrean' => '2025-002',
            ],
        ];

        foreach ($data as $de) {
            daftar_poliModel::create([
                'id_pasien' => $de['id_pasien'],
              
                'id_jadwal' => $de['id_jadwal'],
                'tanggal_daftar' => $de['tanggal_daftar'],
                'no_antrean' => $de['no_antrean'],
            ]);
        }
    }
}
