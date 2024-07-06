<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->role->code == "client"){
            return response()->json([
                    'success' => true,
                    'complaints' => auth()->user()->complaints
                    #'complaints' => auth()->user()->complaints()->paginate(10)
                ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Forbidden'
            ], 403);
        }
    }

    public function create_complaint(Request $request)
    {
        #dd($request->all(), $request->hasFile('images'));
        // Validation des données d'entrée
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        #dd($request->images);
        $images = [];
        // Gestion du téléchargement des images
        if ($request->images) {
            foreach ($request->images as $file) {
                // Stocker chaque image dans le dossier 'complaints' à la racine du répertoire public
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->move(public_path('complaints'), $fileName);
                $images[] = $fileName;
            }
        }
        // Convertir la liste des chemins d'images en JSON
        $validated['images'] = json_encode($images);
        // Création de la plainte
        $validated['status'] = true;
        $validated['state'] = 'pending';
        $validated['user_id'] = $request->user()->id;
        $complaint = Complaint::create($validated);
        // Rediriger ou retourner une réponse appropriée
        return response()->json([
            'success' => true,
            'message' => 'Sinietro registrodo con éxito !'
        ]);
    }

}
