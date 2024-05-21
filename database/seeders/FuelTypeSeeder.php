<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuel_types = [
            'Gasolina',
            'Diesel'
        ];

        foreach ($fuel_types as $fuel_type){
            FuelType::create([
               'title' => $fuel_type,
               'code' => substr($fuel_type, 0, 1),
               'status' => true
            ]);
        }
    }
}
