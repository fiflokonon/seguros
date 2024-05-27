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
            'Vehículo Utilitario Con Carga  Util <3.5 T',
            'Vehículo Utilitario Con Carga Util >3.5 T',
            'Scooter Uso Comercial',
            '2 / 3 Carretera Uso Personal',
            'Taxis, Car Sin Doble Mando',
            'Vehículo Utilitario >3.5 T Con Doble Mando',
            'Vehículos 2 y 3 Ruedas',
            'Scooter',
            'Scooter Uso Comercial',
            'Scooter Uso Personal',
            'Vehículo Utilitario >3.5 T Con Doble Mando',
            'Vehículo Utilitario <3.5 T Con Doble Mando',
            'Vehículo Turismo Sin Doble Mando',
            'Vehículo Turismo con Doble mando',
            'Scooter Con RC Elevado',
            'Vehículo Utilitario < 3,5 T Con Conductor',
            'Taxis, Car Con Doble Mando',
            'Vehículo Utilitario > 3,5 T Con Conductor',
            'Vehículo de Turismo con Conductor',
            'Tractores Agricolas y Forestales',
            'Ambulancias, Ruidos, Furgonetas Funerarias',
            'Vehículo de Colectividad Público < 3.5 T',
            'Vehículos de Colectividad Publica > 3.5 T',
        ];

        foreach ($car_types as $car_type){
            TypeCar::create([
                'title' => $car_type,
                'status' => true
            ]);
        }
    }
}
