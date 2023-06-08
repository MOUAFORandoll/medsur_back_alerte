<?php

namespace Database\Seeders;

use App\Models\Localisation;
use Illuminate\Database\Seeder;

class LocalisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localisations = Localisation::factory()->count(50)->create();
    }
}
