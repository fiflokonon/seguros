<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TypeCar;
use Illuminate\Http\Request;

class TypeCarController extends Controller
{
    public function index()
    {
        $types = TypeCar::all();
        return view('dashboard.type_cars.index', [
            'types' => $types
        ]);
    }
}
