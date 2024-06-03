<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintAnswer;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        if (auth()->user()->role->code == "client"){
            return view('dashboard.complaints.index', [
                'complaints' => auth()->user()->complaints()->paginate(10)
            ]);
        }else{
            $complaints = Complaint::paginate(10);
            return view('dashboard.complaints.index', [
                'complaints' => $complaints
            ]);
        }

    }

    public function add_complaint()
    {
        return view('dashboard.complaints.new_complaint');
    }

    public function store(Request $request)
    {
        #dd($request->all(), $request->hasFile('images'));
        // Validation des données d'entrée
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = [];
        // Gestion du téléchargement des images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Stocker chaque image dans le dossier 'complaints' à la racine du répertoire public
                $fileName = time() . '_' . $file->getClientOriginalExtension();
                $filePath = $file->move(public_path('complaints'), $fileName);
                $images[] = $fileName;
            }
        }
        // Convertir la liste des chemins d'images en JSON
        $validated['images'] = json_encode($images);
        // Création de la plainte
        $validated['status'] = true;
        $validated['state'] = 'pending';
        $validated['user_id'] = auth()->user()->id;
        $complaint = Complaint::create($validated);
        // Rediriger ou retourner une réponse appropriée
        return redirect()->back()->with('success', 'Sinietro registrodo con éxito !');
    }

    public function complaint_details($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('dashboard.complaints.complaint_details', [
            'complaint' => $complaint
        ]);
    }

    public function answer_complaint($id, Request $request)
    {
        $complaint = Complaint::findOrFail($id);
        $validated = $request->validate([
            'body' => 'required|string',
        ]);
        try {
            ComplaintAnswer::create([
                'complaint_id' => $complaint->id,
                'user_id' => auth()->user()->id,
                'body' => $request->body,
                'status' => true
            ]);
            $complaint->state = 'opened';
            $complaint->save();
            return back()->with('success', 'Respuesta enviada con éxito !');
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }
}
