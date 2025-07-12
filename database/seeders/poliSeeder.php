<?php

namespace Database\Seeders;

use App\Models\poliModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class poliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'nama_poli' => 'poli Gigi',
                'kode_poli' => 'PG',
                'spesialis' => 'Gigi dan Mulut',
            ],
            [
                'nama_poli' => 'poli Jantung',
                'kode_poli' => 'PJ',
                'spesialis' => 'Jantung dan Pembuluh Darah',
            ],
            [
                'nama_poli' => 'poli Ginjal',
                'kode_poli' => 'PGJL',
                'spesialis' => 'Ginjal dan Paru-Paru',
            ],
        ];

        foreach ($data as $de) {
            poliModel::create([
                'nama_poli' => $de['nama_poli'],
                'kode_poli' => $de['kode_poli'],
                'spesialis' => $de['spesialis'],

            ]);
        }
    }
}
