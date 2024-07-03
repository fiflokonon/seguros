<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CarCategory;
use App\Models\FuelType;
use App\Models\Parameter;
use App\Models\Trailer;
use App\Models\TypeCar;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function fuel_types()
    {
        $fuel_types = FuelType::with('powers')->where('status', true)->get();
        if ($fuel_types)
            return response()->json(['success' => true, 'response' => $fuel_types]);
        else
            return response()->json(['success' => false, 'message' => 'No hay tipo de combustible en la base.'], 404);
    }

    public function car_categories()
    {
        $car_categories = CarCategory::where('status', true)->get();
        if ($car_categories)
            return response()->json(['success' => true, 'response' => $car_categories]);
        else
            return response()->json(['success' => false, 'message' => 'No hay categoría de coche en la base de datos.'], 404);
    }

    public function type_cars()
    {
        $type_cars = TypeCar::where('status', true)->get();
        if ($type_cars)
            return response()->json(['success' => true, 'response' => $type_cars]);
        else
            return response()->json(['success' => false, 'message' => 'No hay tipo de coche en la base de datos.'], 404);
    }

    public function trailers()
    {
        $trailers = Trailer::where('status', true)->get();
        if ($trailers)
            return response()->json(['success' => true, 'response' => $trailers]);
        else
            return response()->json(['success' => false, 'message' => 'No hay tipo de remolque en la base de datos.'], 404);
    }

    public function brands()
    {
        $mas = Brand::where('most_used', true)->get();
        $minos = Brand::where('most_used', false)->get();
        return response()->json([
            'success' => true,
            'response' => [
                'most_used' => $mas,
                'less_used' => $minos
            ]
        ]);
    }

    public function accessories()
    {
        $accessories = Parameter::where('accessory', true)->get();
        return response()->json([
            'success' => true,
            'response' => $accessories
        ]);
    }
}
