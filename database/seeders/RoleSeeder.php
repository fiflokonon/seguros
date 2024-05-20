<?php

namespace Database\Seeders;

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
    }
}
