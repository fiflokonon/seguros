<?php

namespace Database\Seeders;

use App\Models\TypeCar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $car_types = [
            'Vehículo de Turismo',
        ];

        foreach ($car_types as $car_type){
            TypeCar::create([
                'title' => $car_type,
                'status' => true
            ]);
        }
    }
}
