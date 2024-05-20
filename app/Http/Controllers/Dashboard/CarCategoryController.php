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
        ]);
        // Générer un code unique de 3 chiffres
        do {
            $code = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
        } while (CarCategory::where('code_category', $code)->exists());

        // Ajouter le code unique aux données validées
        $validatedData['code_category'] = $code;
        $validatedData['status'] = true;
        // Créer la nouvelle catégorie de voiture
        $carCategory = CarCategory::create($validatedData);
        // Retourner une réponse appropriée
        return back()->with('success', 'Categoria insertien');
    }
}
