<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use App\Models\Power;
use Illuminate\Http\Request;
use function Psy\bin;

class PowerController extends Controller
{
    public function index()
    {
        $powers = Power::paginate(5);
        return view('dashboard.powers.index', [
            'powers' => $powers,
            'fuel_types' => FuelType::all()
        ]);
    }

    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'min_power' => 'required|integer|min:0',
            'max_power' => 'required|integer|gt:min_power',
            'fuel_type' => 'array',
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
        $power->fuel_types()->attach($request->input('fuel_type', []));
        // Retourner une réponse appropriée
        return back()->with('success', 'Potentia insertien');
    }

    public function updatePower(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:powers,id',
            'min_power' => 'required|numeric|min:1',
            'max_power' => 'required|numeric|min:1',
            'fuel_type' => 'required|array',
            'fuel_type.*' => 'exists:fuel_types,id',
        ]);

        $power = Power::find($request->id);
        $power->min_power = $request->min_power;
        $power->max_power = $request->max_power;
        $power->fuel_types()->sync($request->fuel_type);
        $power->save();
        return redirect()->back()->with('success', 'Potencia actualizada con éxito.');
    }

    public function activatePower(int $id)
    {
        $power = Power::find($id);
        if (!$power->status){
            $power->status = true;
            $power->save();
            return back()->with('success', 'Potencia activada con éxito');
        }else{
            return back()->withErrors(['error' => 'No se puede activar esta potencia']);
        }
    }

    public function deactivatePower(int $id)
    {
        $power = Power::find($id);
        if ($power->status){
            $power->status = false;
            $power->save();
            return back()->with('success', 'Potencia desactivada con éxito');
        }else{
            return back()->withErrors(['error' => 'No se puede desactivar esta potencia']);
        }
    }
}
