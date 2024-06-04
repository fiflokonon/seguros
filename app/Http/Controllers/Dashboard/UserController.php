<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        #dd($request->all());
        // Validation des données d'entrée
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sex' => 'nullable|in:M,F',
            'city' => 'nullable|string|max:255',
            'role' => 'required|integer|exists:roles,id',
            'district' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'id_passport' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:8',
            'status' => 'required'
        ]);

        // Gestion du téléchargement de l'image de profil
        if ($request->hasFile('profile_picture')) {
            // Stocker la nouvelle image de profil
            $file = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('profile_pics'), $fileName);
            $validated['profile_picture'] = $fileName;
        }
        // Hash du mot de passe
        $validated['password'] = Hash::make($validated['password']);
        $validated['role_id'] = $validated['role'];
        // Création de l'utilisateur
        $user = User::create($validated);
        if ($request->status == 1){
            $user->verified_email = true;
            $user->email_verified_at = now();
            $user->status = true;
            $user->save();
        }
        // Rediriger ou retourner une réponse appropriée
        return redirect()->back()->with('success', 'Usuario creado con éxito.');
    }
}
