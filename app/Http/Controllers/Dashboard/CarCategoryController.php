<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    public function index()
    {
        $categories = CarCategory::all();
        return view('dashboard.car_categories.index', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:car_categories,title',
            'code_category' => 'required|string|max:255|unique:car_categories,code_category',
        ]);
        $validatedData['status'] = true;
        // Créer la nouvelle catégorie de voiture
        $carCategory = CarCategory::create($validatedData);
        // Retourner une réponse appropriée
        return back()->with('success', 'Categoria insertien');
    }

    public function update(Request $request)
    {
        // Valider les données entrantes
        $request->validate([
            'id' => 'required|exists:car_categories,id',
            'title' => 'required|string|max:255',
            'code_category' => 'required|integer',
        ]);
        // Rechercher l'élément à mettre à jour
        $carCategory = CarCategory::findOrFail($request->id);
        // Mettre à jour les champs de l'élément
        $carCategory->title = $request->title;
        $carCategory->code_category = $request->code_category;
        // Enregistrer les modifications
        $carCategory->save();
        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Categoría actualizada con éxito.');
    }
}
