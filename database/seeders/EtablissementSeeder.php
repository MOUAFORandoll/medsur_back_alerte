<?php

namespace Database\Seeders;

use App\Models\Etablissement;
use Illuminate\Database\Seeder;

class  EtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etablissements = Etablissement::factory()->count(50)->create();
    }
}
