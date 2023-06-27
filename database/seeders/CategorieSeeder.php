<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Specialite;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Hôpital", "Pharmacie", " Laboratoire d'imagerie", "Centre d'imagerie"];
        $categories_en   = ["Hospital", "Pharmacy", "Imaging Laboratory", "Imaging Center"];
        for ($i = 0; $i < count($categories); $i++) {
            Categorie::create(['libelle' => $categories[$i], 'libelle_en' => $categories_en[$i]]);
        }
    }
}
