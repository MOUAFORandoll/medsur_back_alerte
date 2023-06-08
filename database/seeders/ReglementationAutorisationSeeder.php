<?php

namespace Database\Seeders;

use App\Models\ReglementationAutorisation;
use Illuminate\Database\Seeder;

class ReglementationAutorisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reglementations = ReglementationAutorisation::factory()->count(500)->create();
    }
}
