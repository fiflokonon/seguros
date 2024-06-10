<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    public function index()
    {
        $parameters = Parameter::all();
        return view('dashboard.parameters.index', [
            'parameters' => $parameters
        ]);
    }

    public function update(Request $request)
    {
        // Validation des données
        $request->validate([
            'id' => 'required|integer|exists:parameters,id',
            'value' => 'required|numeric',
        ]);
        // Récupération du paramètre à mettre à jour
        $parameter = Parameter::findOrFail($request->id);
        // Mise à jour des attributs du paramètre
        $parameter->value = $request->input('value');
        // Sauvegarde des modifications
        $parameter->save();
        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Paramétro actualizado con éxito.');
    }
}
