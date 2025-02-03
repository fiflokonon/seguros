<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use App\Models\Power;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    public function index()
    {
        $fuel_types = FuelType::paginate(10);
        return view('dashboard.fuel_types.index', [
            'fuel_types' => $fuel_types,
            'powers' => Power::all()
        ]);
    }

    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:fuel_types,title',
            'description' => 'nullable|string',
            'code' => 'required|string|max:255|unique:fuel_types,code',
            'power' => 'array',
        ]);
        $validatedData['status'] = true;
        // Créer la nouvelle catégorie de carburant
        $fuelType = FuelType::create($validatedData);
        $fuelType->powers()->attach($request->input('power', []));
        // Retourner une réponse appropriée
        return back()->with('success', 'Tipo combustible insertien');
    }

    public function update(Request $request)
    {
        // Valider les données entrantes
        $request->validate([
            'id' => 'required|exists:fuel_types,id',
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'power' => 'array',
            'power.*' => 'exists:powers,id',
        ]);
        // Rechercher l'élément à mettre à jour
        $fuelType = FuelType::findOrFail($request->id);
        // Mettre à jour les champs de l'élément
        $fuelType->title = $request->title;
        $fuelType->code = $request->code;
        // Gérer les relations (comme les puissances)
        if ($request->has('power')) {
            $fuelType->powers()->sync($request->power);
        }
        // Enregistrer les modifications
        $fuelType->save();
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Tipo de combustible actualizado con éxito.');
    }

    public function activateFuelType(int $id)
    {
        $fuelType = FuelType::find($id);
        if (!$fuelType->status){
            $fuelType->status = true;
            $fuelType->save();
            return back()->with('success', 'Tipo de combustible desactivado con éxito');
        }else{
            return back()->withErrors(['error' => 'No se puede activar este tipo de combustible']);
        }
    }

    public function deactivateFuelType(int $id)
    {
        $fuelType = FuelType::find($id);
        if ($fuelType->status){
            $fuelType->status = false;
            $fuelType->save();
            return back()->with('success', 'Tipo de combustible desactivado con éxito');
        }else{
            return back()->withErrors(['error' => 'No se puede desactivar este tipo de combustible']);
        }
    }
}
