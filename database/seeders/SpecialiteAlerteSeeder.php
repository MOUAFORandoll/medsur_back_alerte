<?php

namespace Database\Seeders;

use App\Models\SpecialiteAlerte;
use Illuminate\Database\Seeder;

class SpecialiteAlerteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                   $specialite_alerte = SpecialiteAlerte::factory()->count(200)->create();
 }
}
