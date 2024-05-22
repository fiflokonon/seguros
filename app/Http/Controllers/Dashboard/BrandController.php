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

    public function store(Request $request)
    {
        #dd($request->all());
        // Valider les données du formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'most_used' => 'required',
            'image' => 'nullable|max:2048'
        ]);

        // Initialiser une variable pour stocker le chemin de l'image
        $imagePath = null;

        // Vérifier s'il y a un fichier image dans la requête
        if ($request->hasFile('image')) {
            // Récupérer le fichier image
            $image = $request->file('image');

            // Définir le nom du fichier avec un timestamp pour le rendre unique
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Stocker l'image dans le répertoire public/brands à la racine du projet
            $image->move(public_path('brands'), $imageName);
            // Définir le chemin d'accès complet de l'image
            $imagePath = 'brands/' . $imageName;
        }

        // Créer une nouvelle instance de Brand avec les données du formulaire
        $brand = new Brand([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'most_used' => $request->get('most_used'),
            'image' => $imagePath, // Affecter null si aucune image n'est téléchargée
            'status' => true,
        ]);
        // Sauvegarder le nouvel enregistrement de marque dans la base de données
        $brand->save();
        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Brand created successfully.');
    }

    public function client_brands()
    {
        $mas = Brand::where('most_used', true)->get();
        $minos = Brand::where('most_used', false)->get();
        return view('dashboard.client.brands', [
            'mas' => $mas,
            'minos' => $minos
        ]);
    }
}
