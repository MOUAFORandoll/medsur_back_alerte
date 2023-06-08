<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
        ]);
    }
}




