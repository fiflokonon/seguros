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
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone' => '+22956',
                'sex' => 'M',
                'role_id' => $admin_role->id,
                'password' => Hash::make('password'),
                'status' => true,
                'verified_email' => true,
                'email_verified_at' => now()
            ]
        ]);
    }
}
