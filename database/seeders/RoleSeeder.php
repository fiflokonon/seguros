<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $code_admin_permissions = [
            'get-dashboard',
            'get-users',
            'deactivate-users',
            'edit-users',
            'get-users-details',
            'add-users',
            'get-roles',
            'add-roles',
            'deactivate-roles',
            'edit-roles',
            'get-roles-details',
            'get-parameters',
            'edit-parameters',
        ];
        $client_role = Role::firstOrCreate([
            'code' => 'client'
        ], [
            'title' => 'Cliente',
            'description' => 'Cliente',
            'status' => true
        ]);

        $admin_role = Role::firstOrCreate([
            'code' => 'admin'
        ], [
            'title' => 'Súper Administrador',
            'description' => 'Súper Administrador',
            'status' => true
        ]);

        $gestor_role = Role::firstOrCreate([
            'code' => 'manager'
        ], [
            'title' => 'Gestor',
            'description' => 'Gestor',
            'status' => true
        ]);

        $control_role = Role::firstOrCreate([
            'code' => 'controller'
        ], [
            'title' => 'Gepetrol Control',
            'description' => 'Gepetrol Control',
            'status' => true
        ]);
        $admin_permissions = Permission::whereIn('code', $code_admin_permissions)->get();
        $admin_role->permissions()->sync($admin_permissions->pluck('id'));
    }
}
