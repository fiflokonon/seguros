<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.index', [
            'roles' => $roles
        ]);
    }

    public function indexAddRole()
    {
        $permissions = Permission::all();
        return view('dashboard.roles.addrole', [
            'permissions' => $permissions
        ]);
    }

    public function addRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'permission' => 'array', // Un tableau de permissions
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::create([
            'title' => $request->title,
            'code' => strtolower($request->title),
            'description' => $request->description,
            'status' => true
        ]);
        $role->permissions()->attach($request->input('permission', []));
        return redirect()->route('rolelist')->with('success', 'Rôle ajouté avec succès.');
    }

    public function activateRole(int $id)
    {
        $role = Role::find($id);
        if ($role->status){
            $role->status = true;
            $role->save();
            return back()->with('success', 'Rôle désactivé avec succès');
        }else{
            return back()->withErrors(['error' => "Impossible d'activer ce role"]);
        }
    }

    public function deactivateRole(int $id)
    {
        $role = Role::find($id);
        if ($role && $role->users->isEmpty()){
            $role->status = false;
            $role->save();
            return back()->with('success', 'Rôle désactivé avec succès');
        }else{
            return back()->withErrors(['error' => 'Impossible de désactiver ce role']);
        }
    }

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'permission' => 'array', // Un tableau de permissions
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::find($id);

        if (!$role) {
            return back()->withErrors(['error' => 'Rôle non trouvé.'])->withInput();
        }

        $role->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Assurez-vous que la table de liaison est correctement configurée (permissions_roles)
        $role->permissions()->sync($request->input('permission', []));
        return redirect()->route('rolelist')->with('success', 'Rôle mis à jour avec succès.');
    }

    public function roleShow(int $id)
    {
        $role = Role::find($id);
        if ($role)
        {
            return view('dashboard.roles.editrole', [
                'role' => $role,
                'permissions' => Permission::all()
            ]);
        }else{
            return redirect()->route('error-not-found');
        }
    }

    public function roleDetails(int $id)
    {
        $role = Role::find($id);
        if ($role)
        {
            return view('dashboard.roles.role_details', [
                'role' => $role,
            ]);
        }else{
            return redirect()->route('error-not-found');
        }
    }

}
