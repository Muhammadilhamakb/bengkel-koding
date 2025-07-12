<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\periksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_pasien' => '1',
                'id_dokter' => '2',
                'catatan' => 'sakit perut jangan telat makan ya',
                'biaya_periksa' => 600000,
                'tgl_periksa' => '2024-03-01',
                'totalHarga' => 5000000,
                'status' => 'sudah diperiksa',
                'id_daftar' => '1',
                'total_obat' => 5,
                'keluhan' => 'sakit perut',
                'waktu_diperiksa' => '2025-06-22 10:00:00',

            ],
            [
                'id_pasien' => '2',
                'id_dokter' => '4',
                'catatan' => 'sakit perut jangan telat makan ya',
                'biaya_periksa' => 600000,
                'tgl_periksa' => '2024-03-01',
                'totalHarga' => 5000000,
                'status' => 'sudah diperiksa',
                'id_daftar' => '1',
                'total_obat' => 5,
                'keluhan' => 'sakit perut',
                'waktu_diperiksa' => '2025-06-22 10:00:00',

            ],
        ];
        foreach ($data as $d) {
            periksa::create([
                'id_pasien' => $d['id_pasien'],
                'id_dokter' => $d['id_dokter'],
                'catatan' => $d['catatan'],
                'biaya_periksa' => $d['biaya_periksa'],
                'tgl_periksa' => $d['tgl_periksa'],
                'totalHarga' => $d['totalHarga'],
                'status' => $d['status'],
                'id_daftar' => $d['id_daftar'],
                'total_obat' => $d['total_obat'],
                'keluhan' => $d['keluhan'],
                'waktu_diperiksa' => $d['waktu_diperiksa'],

            ]);
        }
    }
}
