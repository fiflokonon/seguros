<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\FuelType;
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
}
