<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::where('code', 'admin')->first();
        $client_role = Role::where('code', 'client')->first();
        $manager_role = Role::where('code', 'manager')->first();
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone' => '+24010000010',
                'sex' => 'M',
                'role_id' => $admin_role->id,
                'password' => Hash::make('password'),
                'status' => true,
                'verified_email' => true,
                'email_verified_at' => now()
            ],
            [
                'first_name' => 'Cliente',
                'last_name' => 'Cliente',
                'email' => 'client@admin.com',
                'phone' => '+24011000010',
                'sex' => 'F',
                'role_id' => $client_role->id,
                'password' => Hash::make('password'),
                'status' => true,
                'verified_email' => true,
                'email_verified_at' => now()
            ],
            [
                'first_name' => 'Gestor',
                'last_name' => 'Gestor',
                'email' => 'gestor@admin.com',
                'phone' => '+24011200010',
                'sex' => 'M',
                'role_id' => $manager_role->id,
                'password' => Hash::make('password'),
                'status' => true,
                'verified_email' => true,
                'email_verified_at' => now()
            ]
        ]);
    }
}
