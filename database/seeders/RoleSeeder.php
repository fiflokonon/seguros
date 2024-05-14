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
            'title' => 'Client',
            'description' => 'Utilisateur mobile',
            'status' => true
        ]);

        $admin_role = Role::firstOrCreate([
            'code' => 'admin'
        ], [
            'title' => 'Admin',
            'description' => 'Utilisateur système',
            'status' => true
        ]);
    }
}
