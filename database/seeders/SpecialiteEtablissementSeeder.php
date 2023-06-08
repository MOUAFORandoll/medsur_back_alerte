<?php

namespace Database\Seeders;

use App\Models\SpecialiteEtablissement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialiteEtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialite_etablissement = SpecialiteEtablissement::factory()->count(200)->create();

    }
}
