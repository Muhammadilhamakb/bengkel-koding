<?php

namespace Database\Seeders;

use App\Models\pasienModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'user_id' => '1',
                'no_ktp' => '1234567891',
               
                'no_rm' => '2025-02-02',

            ],
            [
                'user_id' => '3',
                'no_ktp' => '1234567890',
              
                'no_rm' => '2025-01-01',

            ],
        ];
        foreach ($data as $o) {
            pasienModel::create([
                'user_id' => $o['user_id'],
                'no_ktp' => $o['no_ktp'],
               
                'no_rm' => $o['no_rm'],

            ]);
        }
    }
}
