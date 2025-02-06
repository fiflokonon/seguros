<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(10);
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

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|exists:brands,id',
            'title' => 'required|string|max:255',
            'most_used' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = Brand::find($validatedData['id']);
        $brand->title = $validatedData['title'];
        $brand->most_used = $validatedData['most_used'];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('brands', 'public');
            $brand->image = '/storage/' . $imagePath;
        }

        $brand->save();

        return redirect()->back()->with('success', 'Marca actualizada con éxito');
    }

    public function activate_brand(int $id)
    {
        $brand = Brand::find($id);
        if (!$brand->status){
            $brand->status = true;
            $brand->save();
            return back()->with('success', 'Marca activada con éxito');
        }else{
            return back()->withErrors(['error' => 'No se puede activar esta marca']);
        }
    }

    public function deactivate_brand(int $id)
    {
        $brand = Brand::find($id);
        if ($brand->status){
            $brand->status = false;
            $brand->save();
            return back()->with('success', 'Marca desactivada con éxito');
        }else{
            return back()->withErrors(['error' => 'No se puede desactivar esta marca']);
        }
    }


    /*public function client_brands()
    {
        $mas = Brand::where('most_used', true)->get();
        $minos = Brand::where('most_used', false)->get();
        if (auth()->user()){
            return view('dashboard.client.brands', [
                'mas' => $mas,
                'minos' => $minos
            ]);
        }else{
            return view('dashboard.client.without_auth_brands', [
                'mas' => $mas,
                'minos' => $minos
            ]);
        }
    }*/

    public function client_brands()
    {
        $mas = Brand::where('most_used', true)->where('status', true)->get();
        $minos = Brand::where('most_used', false)->where('status', true)->get();
        return view('dashboard.client.brands', [
            'mas' => $mas,
            'minos' => $minos
        ]);
    }
}
