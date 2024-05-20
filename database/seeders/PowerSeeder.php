<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('powers')->insert([
           [
               'min_power' => 2,
               'max_power' => 5,
               'status' => true
           ],
            [
                'min_power' => 3,
                'max_power' => 5,
                'status' => true
            ],
            [
                'min_power' => 7,
                'max_power' => 15,
                'status' => true
            ],
        ]);
    }
}
