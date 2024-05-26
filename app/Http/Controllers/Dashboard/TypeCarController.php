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

    public function update(Request $request)
    {
        // Validation des données
        $request->validate([
            'id' => 'required|integer|exists:type_cars,id',
            'title' => 'required|string|max:255',
        ]);
        // Récupération du type de voiture à mettre à jour
        $typeCar = TypeCar::findOrFail($request->id);
        // Mise à jour des attributs du type de voiture
        $typeCar->title = $request->input('title');
        // Sauvegarde des modifications
        $typeCar->save();
        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Tipo coche actualizado con éxito.');
    }
}
