<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TypeCar;
use Illuminate\Http\Request;

class TypeCarController extends Controller
{
    public function index()
    {
        $types = TypeCar::all();
        return view('dashboard.type_cars.index', [
            'types' => $types
        ]);
    }

    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:fuel_types,title',
            'description' => 'nullable|string',
        ]);
        $validatedData['status'] = true;
        // Créer la nouvelle catégorie de carburant
        $typeCar = TypeCar::create($validatedData);
        // Retourner une réponse appropriée
        return back()->with('success', 'Tipo coche insertien');
    }
}
