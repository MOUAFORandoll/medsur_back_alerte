<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            LocalisationSeeder::class,
            SpecialiteSeeder::class,
            EtablissementSeeder::class,
            GarantiSeeder::class,
            AgendaSeeder::class,
            NotationSeeder::class,
            AgendaEtablissementSeeder::class,
            AlerteSeeder::class,
            SpecialiteAlerteSeeder::class,
            SpecialiteEtablissementSeeder::class,
            // ReglementationAutorisationSeeder::class,
        ]);
    }
}
