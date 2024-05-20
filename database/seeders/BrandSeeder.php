<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            "Audi",
            "Buick",
            "Acura",
            "Aston Martin",
            "Bentley",
            "BMW",
            "Cadillac",
            "Chevrolet",
            "Chrysler",
            "Citroën",
            "Daihatsu",
            "Ferrari",
            "Fiat",
            "Ford",
            "General Motors",
            "Honda",
            "Hyundai",
            "Infiniti",
            "Isuzu",
            "Jaguar",
            "Jeep",
            "KIA",
            "Lancia",
            "Land Rover",
            "Lexus",
            "Lincoln",
            "Mazda",
            "Mercedes-Benz",
            "Mini",
            "Mitsubishi",
            "Nissan",
            "Oldsmobile",
            "Opel",
            "Peugeot",
            "Porsche",
            "Renault",
            "Škoda",
            "Subaru",
            "Suzuki",
            "Toyota",
            "Volkswagen",
            "Volvo",
        ];

        foreach ($brands as $brand) {
            $original_brand = $brand;
            $brand = strtolower($brand); // Convertir la marque en minuscule

            // Remplacer les accents par des caractères sans accent
            $brand = str_replace(['é', 'è', 'ê', 'ë'], 'e', $brand);
            $brand = str_replace(['ç'], 'c', $brand);
            $brand = str_replace(['à', 'â'], 'a', $brand);
            $brand = str_replace(['î', 'ï'], 'i', $brand);
            $brand = str_replace(['ô', 'ö'], 'o', $brand);
            $brand = str_replace(['ù', 'ü'], 'u', $brand);
            $brand = str_replace(['Š'], 's', $brand);

            if ($brand == 'aston martin')
                $brand = 'aston-martin';
            if ($brand == 'general motors'){
                $brand = 'gm';
            }
            if ($brand == 'land rover'){
                $brand = 'land-rover';
            }
            // Générer le chemin de l'image
            $imagePath = '/brands/' . $brand . '.png';
            if ($brand == 'daihatsu' || $brand == 'bentley' || $brand == 'cadillac' || $brand == 'isuzu'){
                $imagePath = '/brands/' . $brand . '.svg';
            }
            Brand::firstOrCreate([
                'title' => $original_brand,
                'image' => $imagePath,
                'most_used' => true,
                'status' => true
            ]);
        }
    }
}
