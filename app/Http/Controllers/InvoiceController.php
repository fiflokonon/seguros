<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Brand;
use App\Models\Complaint;
use App\Models\FuelType;
use App\Models\Invoice;
use App\Models\Parameter;
use App\Models\Tarification;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use function Symfony\Component\String\b;

class InvoiceController extends Controller
{
    public function invoice_form($id)
    {
        $brand = Brand::findOrFail($id);
        return view('dashboard.client.invoice_form', [
            'brand' => $brand
        ]);
    }

    public function index()
    {
        if (auth()->user()->role->code == "client"){
            return view('dashboard.invoices.index', [
                'invoices' => auth()->user()->invoices
            ]);
        }else{
            return view('dashboard.invoices.index', [
                'invoices' => Invoice::paginate(5),
                'pending_complaints' => Complaint::where('state', 'pending')->count(),
                'opened_complaints' => Complaint::where('state', 'opened')->count(),
                'closed_complaints' => Complaint::where('state', 'closed')->count(),
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
                'phone' => 'required|string|max:255',
                'accessory' => 'array'
            ]);

            // Générer un code unique alphanumérique
            $code = $this->generateUniqueCode();

            // Récupérer la valeur du paramètre "Attestation"
            $attestation = Parameter::where('title', 'Attestación')->first();
            $attestationValue = $attestation ? $attestation->value : 0;
            // Récupérer la valeur du paramètre "Attestation"
            $accessorio = Parameter::where('title', 'Accesorios')->first();
            $accessorioValue = $accessorio ? $accessorio->value : 0;
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
            $subTotal = $tarification->price + $attestationValue + $accessorioValue;
            $accessories_price = 0;
            #Log::info("Entry subtotal : $subTotal");
            #Log::info("Entry access price : $accessories_price");
            #Log::info("Accessories entry");
            foreach ($request->input('accessory', []) as $item) {
                $accessory = Parameter::find($item);
                Log::info("Accessory $item : $accessory->value");
                if ($accessory) {
                    $subTotal += $accessory->value;
                    $accessories_price += $accessory->value;
                }
            }
            #Log::info("Outgoing subtotal : $subTotal");
            #Log::info("Outgoing access price : $accessories_price");
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
            $validatedData['extra_price'] = $accessories_price;
            $validatedData['accessories_price'] = $accessorioValue;
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
            $this->save_invoice_pdf($invoice);
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

    public function sendInvoiceEmail($email, $code, $invoice): bool
    {
        try {
            Mail::to($email)->send(new InvoiceMail($code, $invoice));
            return true; // Email sent successfully
        } catch (\Throwable $e) {
            return false; // Error occurred during email sending
        }
    }

    public function sendInvoice($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice){
            if ($invoice->link != null){
                $email = $this->sendInvoiceEmail($invoice->email, $invoice->code,$invoice->link);
                if ($email){
                    return response()->json(['success' => true, 'message' => 'Factura enviada exitosamente por correo electrónico !']);
                }else{
                    return response()->json(['success' => false, 'message' => 'Error al enviar factura por correo electrónico !']);
                }
            }else{
                /*$pdfData = [
                    'code' => $invoice->code,
                    'sub_total' => $invoice->sub_total,
                    'first_name' => $invoice->first_name,
                    'last_name' => $invoice->last_name,
                    'email' => $invoice->email,
                    'phone' => $invoice->phone,
                    'initial_price' => $invoice->initial_price,
                    'accessories_price' => $invoice->accessories_price,
                    'attestation_price' => $invoice->attestation_price,
                    'vat' => $invoice->vat,
                    'total' => $invoice->total,
                    'date' => $invoice->created_at,
                    'model' => $invoice->model,
                    'regis_number' => $invoice->regis_number,
                    'place_number' => $invoice->place_number,
                    'min_power' => $invoice->power->min_power,
                    'max_power' => $invoice->power->max_power,
                    'trailer' => $invoice->trailer->title
                ];*/
                $this->save_invoice_pdf($invoice);
                $email = $this->sendInvoiceEmail($invoice->email, $invoice->code, $invoice->link);
                if ($email){
                    return response()->json(['success' => true, 'message' => 'Factura enviada exitosamente por correo electrónico !']);
                }else{
                    return response()->json(['success' => false, 'message' => 'Error al enviar factura por correo electrónico !']);
                }
            }
        }
        else{
            return response()->json(['success' => false, 'message' => 'Invoice null'], 404);
        }
    }

    /**
     * @param $invoice
     * @return void
     */
    public function save_invoice_pdf($invoice): void
    {
        $pdfData = [
            'code' => $invoice->code,
            'invoice' => $invoice
        ];
        $pdf = PDF::loadView('factures.facture', $pdfData);
        // Choisissez l'emplacement où vous souhaitez enregistrer le fichier PDF généré
        $pdfFilePath = public_path('factures/' . $invoice->code . '.pdf');
        $pdf->save($pdfFilePath);
        $invoice->link = 'factures/' . $invoice->code . '.pdf';
        $invoice->save();
    }


    public function approve_invoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        if ($invoice->state == 'approved'){
            return back()->withErrors('Already approved');
        }else{
            $invoice->state = 'approved';
            $invoice->save();
            return back()->with('success', 'Approbado con exito !');
        }
    }

    public function refuse_invoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        if ($invoice->state == 'refused'){
            return back()->withErrors('Already refused');
        }else{
            $invoice->state = 'refused';
            $invoice->save();
            return back()->with('success', 'Rechazado con exito !');
        }
    }

}
