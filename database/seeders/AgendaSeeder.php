<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $data = ['Lundi', 'Mardi', "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
        foreach ($data as $sa) {
            Agenda::create(['libelle' => $sa]);
        }
    }
}
