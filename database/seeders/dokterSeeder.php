<?php

namespace Database\Seeders;

use App\Models\dokterModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class dokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => '2',
                'gelar' => 's1 Kedokteran',
                'id_poli' => '1',
            ],
            [
                'user_id' => '4',
                'gelar' => 's1 Kedokteran',
                'id_poli' => '2',
            ],
        ];

        foreach ($data as $de) {
            dokterModel::create([
                'user_id' => $de['user_id'],
                'gelar' => $de['gelar'],
                'id_poli' => $de['id_poli'],
            ]);
        }
    }
}
