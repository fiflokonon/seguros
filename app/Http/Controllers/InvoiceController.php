<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\FuelType;
use App\Models\Invoice;
use App\Models\Parameter;
use App\Models\Tarification;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller
{
    public function invoice_form($id)
    {
        $brand = Brand::findOrFail($id);
        if (auth()->user()){
            return view('dashboard.client.invoice_form', [
                'brand' => $brand
            ]);
        }else{
            return view('dashboard.client.without_auth_invoice_form', [
                'brand' => $brand
            ]);
        }

    }

    public function index()
    {
        if (auth()->user()->role->code == "client"){
            return view('dashboard.invoices.index', [
                'invoices' => auth()->user()->invoices
            ]);
        }else{
            return view('dashboard.invoices.index', [
                'invoices' => Invoice::all()
            ]);
        }
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
        $brand = Brand::findOrFail($id);
        try {
            // Validation des données d'entrée
            $validatedData = $request->validate([
                'user_id' => 'nullable|exists:users,id',
                'fuel_type' => 'required|exists:fuel_types,id',
                'power' => 'required|exists:powers,id',
                'type_car' => 'required|exists:type_cars,id',
                'category' => 'required|exists:car_categories,id',
                'place_number' => 'required|integer',
                'trailer' => 'required|exists:trailers,id',
                'regis_number' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'accessory' => 'array'
            ]);

            // Générer un code unique alphanumérique
            $code = $this->generateUniqueCode();

            // Récupérer la valeur du paramètre "Attestation"
            $attestation = Parameter::where('title', 'Attestación')->first();
            $attestationValue = $attestation ? $attestation->value : 0;

            // Récupérer la tarification
            $tarification = Tarification::where('car_category_id', $validatedData['category'])
                ->where('type_car_id', $validatedData['type_car'])
                ->where('fuel_type_id', $validatedData['fuel_type'])
                ->where('power_id', $validatedData['power'])
                ->where('trailer_id', $validatedData['trailer'])
                ->first();

            if (!$tarification) {
                return response()->json(['success' => false, 'message' => 'No hay cotización para ese tipo de coche.']);
            }

            // Calculer le sous-total
            $subTotal = $tarification->price + $attestationValue;
            $accessories_price = 0;
            Log::info("Entry subtotal : $subTotal");
            Log::info("Entry access price : $accessories_price");
            Log::info("Accessories entry");
            foreach ($request->input('accessory', []) as $item) {
                $accessory = Parameter::find($item);
                Log::info("Accessory $item : $accessory->value");
                if ($accessory) {
                    $subTotal += $accessory->value;
                    $accessories_price += $accessory->value;
                }
            }
            Log::info("Outgoing subtotal : $subTotal");
            Log::info("Outgoing access price : $accessories_price");
            // Calculer le total en ajoutant 15% au sous-total
            $total = $subTotal * 1.15;
            // Préparer les données pour la création de la facture
            $validatedData['total'] = $total;
            $validatedData['car_category_id'] = $validatedData['category'];
            $validatedData['fuel_type_id'] = $validatedData['fuel_type'];
            $validatedData['power_id'] = $validatedData['power'];
            $validatedData['trailer_id'] = $validatedData['trailer'];
            $validatedData['type_car_id'] = $validatedData['type_car'];
            $validatedData['brand_id'] = $brand->id;
            $validatedData['code'] = $code;
            $validatedData['initial_price'] = $tarification->price;
            $validatedData['attestation_price'] = $attestation->value;
            $validatedData['accessories_price'] = $accessories_price;
            $validatedData['sub_total'] = $subTotal;
            $validatedData['vat'] = $subTotal * 0.15;
            $validatedData['status'] = true;
            $validatedData['state'] = 'pending';
            if (auth()->user() != null) {
                $validatedData['user_id'] = auth()->user()->id;
            }

            // Création de l'instance d'Invoice
            $invoice = Invoice::create($validatedData);
            $invoice->accessories()->attach($request->input('accessory', []));

            // Retourne une réponse, par exemple un message de succès ou une redirection
            return response()->json(['success' => true, 'invoice_id' => $invoice->id]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->errors()
            ], 422);
        }
    }

    private function generateUniqueCode()
    {
        do {
            $code = strtoupper(Str::random(10));
        } while (Invoice::where('code', $code)->exists());
        return $code;
    }

    public function invoice_details($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('dashboard.client.invoice_details', [
            'invoice' => $invoice
        ]);
    }

}
