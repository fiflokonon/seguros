<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        return view('dashboard.complaints.index', [
            'complaints' => $complaints
        ]);
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
        $validated['user_id'] = auth()->user()->id;
        $complaint = Complaint::create($validated);
        // Rediriger ou retourner une réponse appropriée
        return redirect()->back()->with('success', 'Complaint created successfully.');
        #return redirect()->route('complaints.show', $complaint->id)->with('success', 'Complaint created successfully.');
    }
}
