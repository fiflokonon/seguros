<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\FuelType;
use App\Models\Invoice;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoice_form($id)
    {
        $brand = Brand::findOrFail($id);
        return view('dashboard.client.invoice_form', [
            'brand' => $brand
        ]);
    }

    public function getPowers($fuelTypeId)
    {
        $fuelType = FuelType::findOrFail($fuelTypeId);
        $powers = $fuelType->powers; // Assuming the relationship is defined in the FuelType model

        return response()->json([
            'powers' => $powers
        ]);
    }

    public function store($id, Request $request)
    {
        dd($request->all());
        $brand = Brand::findOrFail($id);
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'fuel_type' => 'required|exists:fuel_types,id',
            'power' => 'required|exists:powers,id',
            'type_car' => 'required|exists:type_cars,id',
            'car_category' => 'required|exists:car_categories,id',
            'number_place' => 'required|integer',
            'trailer' => 'required|exists:trailers,id',
            'regis_number' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'accessories' => 'array'
        ]);

        // Création de l'instance d'Invoice
        $invoice = Invoice::create($validatedData);

        // Retourne une réponse, par exemple un message de succès ou une redirection
        return ;
    }

}
