<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tarification;
use Illuminate\Http\Request;

class TarificationController extends Controller
{
    public function index()
    {
        $tarifications = Tarification::all();
        return view('dashboard.tarifications.index', [
            'tarifications' => $tarifications
        ]);
    }
}
