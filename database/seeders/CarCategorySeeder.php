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
            [
                'code' => 201,
                'title'  => 'Negocios y paseos'
            ],
            [
                'code' => 202,
                'title'  => 'Vehículos para transporte público de bienes'
            ],
            [
                'code' => 203,
                'title'  => 'Vehículos de transporte público de pasajeros/persona'
            ],
            [
                'code' => 204,
                'title'  => 'Vehículos de motorizados de dos o tres ruedas'
            ],
            [
                'code' => 205,
                'title'  => 'Vehículo conf. al personal de reparación'
            ],
            [
                'code' => 206,
                'title'  => 'Vehículos de auto-escuelas'
            ],
            [
                'code' => 207,
                'title'  => 'Vehículos de alquiler con o sin conductor'
            ],
            [
                'code' => 208,
                'title'  => 'Maquinaria de construcción móvil'
            ],
            [
                'code' => 209,
                'title'  => 'Coches fúnebres, ambulancias, tract. agrícolas'
            ],
        ];

        foreach ($categories as $category){
            CarCategory::create([
                'title' => $category['title'],
                'code_category' => $category['code'],
                'status' => true
            ]);
        }
    }
}
