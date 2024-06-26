<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BrandSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CarCategorySeeder::class);
        $this->call(FuelTypeSeeder::class);
        $this->call(TrailerSeeder::class);
        $this->call(TypeCarSeeder::class);
        $this->call(PowerSeeder::class);
        $this->call(ParameterSeeder::class);
        $this->call(TarificationSeeder::class);
    }
}
