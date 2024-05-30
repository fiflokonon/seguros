<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Trailer;
use Illuminate\Http\Request;

class TrailerController extends Controller
{
    public function index()
    {
        $trailers = Trailer::paginate(10);
        return view('dashboard.trailers.index', [
            'trailers' => $trailers
        ]);
    }

    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|unique:trailers,title',
            'description' => 'nullable|string',
        ]);
        $validatedData['status'] = true;
        // Créer la nouvelle catégorie de carburant
        $trailer = Trailer::create($validatedData);
        // Retourner une réponse appropriée
        return back()->with('success', 'Remolque insertien');
    }

    public function update(Request $request)
    {
        // Validation des données
        $request->validate([
            'id' => 'required|integer|exists:trailers,id',
            'title' => 'required|string|max:255',
        ]);
        $trailer = Trailer::findOrFail($request->id);
        $trailer->title = $request->input('title');
        $trailer->save();
        return redirect()->back()->with('success', 'Tipo remolque actualizado con éxito.');
    }

}
