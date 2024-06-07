<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parameters')->insert([
            [
                'title' => 'Defensa y Recurso',
                'value' => 8460,
                'accessory' => true,
                'status' => true
            ],
            [
                'title' => 'Contrato de Individual Conductor',
                'value' => 6500,
                'accessory' => true,
                'status' => true
            ],
            [
                'title' => 'Contrato Individual Persona Transportada',
                'value' => 6500,
                'accessory' => true,
                'status' => true
            ],
            [
                'title' => 'Attestación',
                'value' => 2000,
                'accessory' => false,
                'status' => true
            ],
            [
                'title' => 'Accesorios',
                'value' => 10000,
                'accessory' => false,
                'status' => true
            ],
        ]);
    }
}
