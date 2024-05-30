<?php

namespace Database\Seeders;

use App\Models\CarCategory;
use App\Models\FuelType;
use App\Models\Power;
use App\Models\Tarification;
use App\Models\Trailer;
use App\Models\TypeCar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat_201 = CarCategory::where('code_category', 201)->first();
        $gasolina = FuelType::where('title', 'Gasolina')->first();
        $diesel = FuelType::where('title', 'Diesel')->first();
        $ve_turismo = TypeCar::where('title', 'Vehículo de Turismo')->first();
        $with_trailer = Trailer::where('title', 'Véhiculo con Remolque')->first();
        $without_trailer = Trailer::where('title', 'Véhiculo sin Remolque')->first();
        $trailer = Trailer::where('title', 'Remolque')->first();
        $p_0_to_1 = Power::where('min_power', 0)->where('max_power', 1)->first();
        $p_0_to_2 = Power::where('min_power', 0)->where('max_power', 2)->first();
        $p_2_to_4 = Power::where('min_power', 2)->where('max_power', 4)->first();
        $p_3_to_6 = Power::where('min_power', 3)->where('max_power', 6)->first();
        $p_5_to_7 = Power::where('min_power', 5)->where('max_power', 7)->first();
        $p_7_to_10 = Power::where('min_power', 7)->where('max_power', 10)->first();
        $p_8_to_10 = Power::where('min_power', 8)->where('max_power', 10)->first();
        $p_11_to_14 = Power::where('min_power', 11)->where('max_power', 14)->first();
        $p_11_to_16 = Power::where('min_power', 11)->where('max_power', 16)->first();
        $p_15_to_23 = Power::where('min_power', 15)->where('max_power', 23)->first();
        $p_17_to_999 = Power::where('min_power', 17)->where('max_power', 999)->first();
        $p_23_to_999 = Power::where('min_power', 23)->where('max_power', 999)->first();
        $p_24_to_999 = Power::where('min_power', 24)->where('max_power', 999)->first();

        $tarifications = [
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_0_to_2->id,
                'trailer_id' => $trailer->id,
                'price' => 8544,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_3_to_6->id,
                'trailer_id' => $trailer->id,
                'price' => 5382,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_7_to_10->id,
                'trailer_id' => $trailer->id,
                'price' => 5904,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_11_to_14->id,
                'trailer_id' => $trailer->id,
                'price' => 13752,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_15_to_23->id,
                'trailer_id' => $trailer->id,
                'price' => 14016,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_23_to_999->id,
                'trailer_id' => $trailer->id,
                'price' => 13989,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_0_to_2->id,
                'trailer_id' => $with_trailer->id,
                'price' => 84600,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_7_to_10->id,
                'trailer_id' => $with_trailer->id,
                'price' => 95988,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_7_to_10->id,
                'trailer_id' => $with_trailer->id,
                'price' => 95988,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_11_to_14->id,
                'trailer_id' => $with_trailer->id,
                'price' => 121608,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_15_to_23->id,
                'trailer_id' => $with_trailer->id,
                'price' => 137784,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_24_to_999->id,
                'trailer_id' => $with_trailer->id,
                'price' => 172704,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $diesel->id,
                'power_id' => $p_0_to_1->id,
                'trailer_id' => $with_trailer->id,
                'price' => 84600,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_0_to_2->id,
                'trailer_id' => $without_trailer->id,
                'price' => 76056,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_3_to_6->id,
                'trailer_id' => $without_trailer->id,
                'price' => 84708,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_11_to_14->id,
                'trailer_id' => $without_trailer->id,
                'price' => 107856,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_15_to_23->id,
                'trailer_id' => $without_trailer->id,
                'price' => 151800,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $gasolina->id,
                'power_id' => $p_24_to_999->id,
                'trailer_id' => $without_trailer->id,
                'price' => 158715,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $diesel->id,
                'power_id' => $p_0_to_2->id,
                'trailer_id' => $without_trailer->id,
                'price' => 76056,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $diesel->id,
                'power_id' => $p_2_to_4->id,
                'trailer_id' => $without_trailer->id,
                'price' => 84708,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $diesel->id,
                'power_id' => $p_5_to_7->id,
                'trailer_id' => $without_trailer->id,
                'price' => 90084,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $diesel->id,
                'power_id' => $p_8_to_10->id,
                'trailer_id' => $without_trailer->id,
                'price' => 107856,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $diesel->id,
                'power_id' => $p_11_to_16->id,
                'trailer_id' => $without_trailer->id,
                'price' => 151800,
                'status' => true
            ],
            [
                'car_category_id' => $cat_201->id,
                'type_car_id' => $ve_turismo->id,
                'fuel_type_id' => $diesel->id,
                'power_id' => $p_17_to_999->id,
                'trailer_id' => $without_trailer->id,
                'price' => 158715,
                'status' => true
            ],
        ];
        foreach ($tarifications as $tarification){
            Tarification::firstOrCreate($tarification);
        }
    }
}
