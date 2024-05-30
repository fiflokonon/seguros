<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Invoice;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role->code == "client"){
            return view('dashboard.index', [
                'invoices' => Invoice::where('user_id', auth()->user()->id)->paginate(5),
                'pending_complaints' => Complaint::where('user_id', auth()->user()->id)->where('state', 'pending')->count(),
                'opened_complaints' => Complaint::where('user_id', auth()->user()->id)->where('state', 'opened')->count(),
                'closed_complaints' => Complaint::where('user_id', auth()->user()->id)->where('state', 'closed')->count(),
            ]);
        }else{
            return view('dashboard.index', [
                'invoices' => Invoice::paginate(5),
                'pending_complaints' => Complaint::where('state', 'pending')->count(),
                'opened_complaints' => Complaint::where('state', 'opened')->count(),
                'closed_complaints' => Complaint::where('state', 'closed')->count(),
                'users_count' => User::count(),
                'invoices_count' => Invoice::count(),
                'complaints_count' => Complaint::count(),
                'roles_count' => Role::count()
            ]);
        }
    }

    public function error403()
    {
        return view('dashboard.error.page-403');
    }
    public function error404()
    {
        return view('dashboard.error.page-404');
    }

    public function profile($id = null)
    {
        if (!$id == null){
            $user = User::findOrFail($id);
        }else{
            $user = auth()->user();
        }
        return view('dashboard.self.profile', [
            'user' => $user
        ]);
    }

    public function edit_profile($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.self.edit_profile', [
            'user' => $user
        ]);
    }

    public function update_profile(Request $request, $id)
    {
        #dd($request->all());
        // Validation des données d'entrée
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sex' => 'nullable|in:M,F',
            'city' => 'nullable|string|max:255',
            'role_id' => 'nullable|integer|exists:roles,id',
            'district' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'id_passport' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'verified_email' => 'nullable|boolean',
            'status' => 'nullable|in:active,inactive',
        ]);

        // Récupérer l'utilisateur à mettre à jour
        $user = User::findOrFail($id);

        // Gestion du téléchargement de l'image de profil
        if ($request->hasFile('profile_picture')) {

            // Stocker la nouvelle image de profil
            $file = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalExtension();
            $filePath = $file->move(public_path('profile_pics'), $fileName);
            $validated['profile_picture'] = $fileName;
        }

        // Hash du mot de passe si nécessaire
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Ne pas écraser le mot de passe s'il n'a pas été mis à jour
            unset($validated['password']);
        }

        // Mise à jour des attributs de l'utilisateur
        $user->update($validated);

        // Rediriger ou retourner une réponse appropriée
        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully.');
    }

}
