<?php

namespace Database\Seeders;

use App\Models\CategorieEtablissement;
use Illuminate\Database\Seeder;

class CategorieEtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorie_etablissement = CategorieEtablissement::factory()->count(50)->create();
    }
}
