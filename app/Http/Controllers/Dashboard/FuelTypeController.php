<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    public function index()
    {
        $fuel_types = FuelType::all();
        return view('dashboard.fuel_types.index', [
            'fuel_types' => $fuel_types
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
        $fuelType = FuelType::create($validatedData);
        // Retourner une réponse appropriée
        return back()->with('success', 'Tipo combustible insertien');
    }
}
