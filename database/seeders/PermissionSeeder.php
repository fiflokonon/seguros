<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'title' => 'Voir ses informations',
                'code' => 'get-user-infos',
                'status' => true
            ],
            [
                'title' => "Accéder au dashboard",
                'code' => 'get-dashboard',
                'status' => true
            ],
            [
                'title' => "Accéder à la liste des utilisateurs",
                'code' => 'get-users',
                'status' => true
            ],
            [
                'title' => "Éditer un utilisateur",
                'code' => 'edit-users',
                'status' => true
            ],
            [
                'title' => "Accéder à la fiche d'un utilisateur",
                'code' => 'get-users-details',
                'status' => true
            ],
            [
                'title' => "Ajouter un utilisateur",
                'code' => 'add-users',
                'status' => true
            ],
            [
                'title' => "Accéder à la liste des roles",
                'code' => 'get-roles',
                'status' => true
            ],
            [
                'title' => "Ajouter un role",
                'code' => 'add-roles',
                'status' => true
            ],
            [
                'title' => "Éditer un role",
                'code' => 'edit-roles',
                'status' => true
            ],
            [
                'title' => "Accéder à la fiche d'un role",
                'code' => 'get-roles-details',
                'status' => true
            ],
            [
                'title' => "Accéder à la liste des paramètres",
                'code' => 'get-parameters',
                'status' => true
            ],
            [
                'title' => "Éditer un paramètre",
                'code' => 'edit-parameters',
                'status' => true
            ],
        ]);

    }
}
