<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Power;
use Illuminate\Http\Request;
use function Psy\bin;

class PowerController extends Controller
{
    public function index()
    {
        $powers = Power::all();
        return view('dashboard.powers.index', [
            'powers' => $powers
        ]);
    }

    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'min_power' => 'required|integer|min:0',
            'max_power' => 'required|integer|gt:min_power'
        ]);
        $existingPower = Power::where('min_power', $validatedData['min_power'])
            ->where('max_power', $validatedData['max_power'])
            ->first();

        if ($existingPower) {
            return back()->withErrors('A power entry with the same min_power and max_power already exists.');
        }
        $validatedData['status'] = true;
        // Créer la nouvelle instance de Power
        $power = Power::create($validatedData);
        // Retourner une réponse appropriée
        return back()->with('success', 'Potentia insertien');
    }
}
