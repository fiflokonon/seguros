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
                'min_power' => 0,
                'max_power' => 1,
                'status' => true
            ],
            [
                'min_power' => 0,
                'max_power' => 2,
                'status' => true
            ],
            [
                'min_power' => 3,
                'max_power' => 6,
                'status' => true
            ],
            [
                'min_power' => 5,
                'max_power' => 7,
                'status' => true
            ],
            [
                'min_power' => 7,
                'max_power' => 10,
                'status' => true
            ],
            [
                'min_power' => 8,
                'max_power' => 10,
                'status' => true
            ],
            [
                'min_power' => 11,
                'max_power' => 14,
                'status' => true
            ],
            [
                'min_power' => 11,
                'max_power' => 16,
                'status' => true
            ],
            [
                'min_power' => 15,
                'max_power' => 23,
                'status' => true
            ],
            [
                'min_power' => 17,
                'max_power' => 999,
                'status' => true
            ],
            [
                'min_power' => 23,
                'max_power' => 999,
                'status' => true
            ],
            [
                'min_power' => 24,
                'max_power' => 999,
                'status' => true
            ],
            [
                'min_power' => 2,
                'max_power' => 4,
                'status' => true
            ],
            [
                'min_power' => 17,
                'max_power' => 9999,
                'status' => true
            ],
        ]);
    }
}
