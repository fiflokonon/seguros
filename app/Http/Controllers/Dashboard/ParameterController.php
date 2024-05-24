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
}
