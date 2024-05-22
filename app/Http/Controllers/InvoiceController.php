<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
}
