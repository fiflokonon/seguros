<?php

namespace Database\Seeders;

use App\Models\Trailer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trailers = [
            'Remolque',
            'Véhiculo con Remolque',
            'Véhiculo sin Remolque'
        ];

        foreach ($trailers as $trailer){
            Trailer::create([
                'title' => $trailer,
                'status' => true
            ]);
        }
    }
}
