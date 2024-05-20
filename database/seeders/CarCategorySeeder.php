<?php

namespace Database\Seeders;

use App\Models\CarCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Negocios y paseos',
            'Vehículo transp. de mercancías a cuenta propia',
            'Vehículos para transporte público de bienes',
            'Vehículos de transporte público de pasajeros/persona',
            'Vehículos de motorizados de dos o tres ruedas',
            'Vehículo conf. al personal de reparación',
            'Vehículos de auto-escuelas',
            'Vehículos de alquiler con o sin conductor',
            'Maquinaria de construcción móvil',
            'Coches fúnebres, ambulancias, tract. agrícolas',
        ];

        foreach ($categories as $category){
            CarCategory::create([
                'title' => $category,
                'code_category' => random_int(0, 20),
                'status' => true
            ]);
        }
    }
}
