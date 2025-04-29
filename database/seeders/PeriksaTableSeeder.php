<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriksaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periksas')->insert([
            [
                'id_pasien' => 2,
                'id_dokter' => 3,
                'tgl_periksa' => now(),
                'catatan' => 'Kontrol Rutin',
                'biaya_periksa' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pasien' => 4,
                'id_dokter' => 1,
                'tgl_periksa' => now()->addDays(1),
                'catatan' => 'Pasien mengalami pusing tak tertahankan',
                'biaya_periksa' => 250000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
