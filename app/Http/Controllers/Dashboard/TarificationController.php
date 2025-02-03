<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarCategory;
use App\Models\FuelType;
use App\Models\Power;
use App\Models\Tarification;
use App\Models\Trailer;
use App\Models\TypeCar;
use Illuminate\Http\Request;

class TarificationController extends Controller
{
    public function index()
    {
        $tarifications = Tarification::paginate(5);
        return view('dashboard.tarifications.index', [
            'tarifications' => $tarifications,
            'categories' => CarCategory::all(),
            'fuel_types' => FuelType::all(),
            'type_cars' => TypeCar::all(),
            'trailers' => Trailer::all(),
            'powers' => Power::all()
        ]);
    }
    public function store(Request $request)
    {
        // Validation des données de la requête
        $validatedData = $request->validate([
            'category' => 'required|integer|exists:car_categories,id',
            'power' => 'required|integer|exists:powers,id',
            'type_car' => 'required|integer|exists:type_cars,id',
            'fuel_type' => 'required|integer|exists:fuel_types,id',
            'trailer' => 'nullable|integer|exists:trailers,id',
            'min_place' => 'integer|nullable|min:1',
            'max_place' => 'integer|nullable|gte:min_place',
            'price' => 'required|numeric|min:0'
        ]);

        // Vérification de l'existence d'une tarification identique
        $existingTarification = Tarification::where([
            ['car_category_id', '=', $validatedData['category']],
            ['power_id', '=', $validatedData['power']],
            ['type_car_id', '=', $validatedData['type_car']],
            ['fuel_type_id', '=', $validatedData['fuel_type']],
            ['trailer_id', '=', $validatedData['trailer']],
            ['min_place', '=', $validatedData['min_place']],
            ['max_place', '=', $validatedData['max_place']],
            ['price', '=', $validatedData['price']],
        ])->first();

        if ($existingTarification) {
            return back()->with('error', 'Une tarification identique existe déjà.');
        }

        try {
            // Création d'une nouvelle tarification
            $tarification = Tarification::create([
                'car_category_id' => $validatedData['category'],
                'power_id' => $validatedData['power'],
                'type_car_id' => $validatedData['type_car'],
                'fuel_type_id' => $validatedData['fuel_type'],
                'trailer_id' => $validatedData['trailer'],
                'min_place' => $validatedData['min_place'],
                'max_place' => $validatedData['max_place'],
                'price' => $validatedData['price'],
                'status' => true
            ]);

            // Retourner une réponse JSON avec succès
            return back()->with('success', 'Cotización insertien');
        } catch (\Exception $e) {
            // En cas d'erreur, retourner une réponse JSON avec l'erreur
            return back()->withErrors($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        #dd($request->all());
        $request->validate([
            'id' => 'required|exists:tarifications,id',
            'category' => 'required|exists:car_categories,id',
            'type_car' => 'required|exists:type_cars,id',
            'fuel_type' => 'required|exists:fuel_types,id',
            'trailer' => 'required|exists:trailers,id',
            'power' => 'required|exists:powers,id',
            'min_place' => 'required|numeric|min:1',
            'max_place' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        $tarification = Tarification::find($request->id);
        $tarification->car_category_id = $request->category;
        $tarification->type_car_id = $request->type_car;
        $tarification->fuel_type_id = $request->fuel_type;
        $tarification->trailer_id = $request->trailer;
        $tarification->power_id = $request->power;
        $tarification->min_place = $request->min_place;
        $tarification->max_place = $request->max_place;
        $tarification->price = $request->price;
        $tarification->save();
        return redirect()->back()->with('success', 'Cotización actualizada con éxito.');
    }

}
