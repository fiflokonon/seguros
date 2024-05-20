<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use Illuminate\Http\Request;

class FuelTypeController extends Controller
{
    public function index()
    {
        $fuel_types = FuelType::all();
        return view('dashboard.fuel_types.index', [
            'fuel_types' => $fuel_types
        ]);
    }
}
