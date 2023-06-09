<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\AgendaEtablissement;
use App\Models\Etablissement;
use Illuminate\Database\Seeder;

class AgendaEtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        $agenda = Agenda::get();
        $etablissements = Etablissement::get();


        foreach ($etablissements as $et) {
            foreach ($agenda as $ag) {
                AgendaEtablissement::create([
                    'debut' => '08:00',
                    'fin' => "18:00",
                    'agenda_id' => $ag->id,
                    'etablissement_id' => $et->id,


                ]);
            }
        }
    }
}
