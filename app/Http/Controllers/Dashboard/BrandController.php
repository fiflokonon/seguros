<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        #$brands = Brand::paginate(10);
        return view('dashboard.brands.index', [
            'brands' => $brands
        ]);
    }
}
