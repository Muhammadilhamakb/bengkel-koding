<?php

namespace Database\Seeders;

use App\Models\jadwal_periksaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_dokter' => '1',
                'id_poli' => '1',
                'hari' => 'senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00',
                'status_aktif' => true,
            ],
            [
                'id_dokter' => '2',
                'id_poli' => '2',
                'hari' => 'selasa',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:00',
                'status_aktif' => false,
            ],
        ];

        foreach ($data as $de) {
            jadwal_periksaModel::create([
                'id_dokter' => $de['id_dokter'],
                'id_poli' => $de['id_poli'],
                'hari' => $de['hari'],
                'jam_mulai' => $de['jam_mulai'],
                'jam_selesai' => $de['jam_selesai'],
                'status_aktif' => $de['status_aktif'],
            ]);
        }
    }
}
