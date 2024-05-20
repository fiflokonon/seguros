<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Trailer;
use Illuminate\Http\Request;

class TrailerController extends Controller
{
    public function index()
    {
        $trailers = Trailer::all();
        return view('dashboard.trailers.index', [
            'trailers' => $trailers
        ]);
    }
}
