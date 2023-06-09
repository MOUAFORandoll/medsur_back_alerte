<?php

namespace Database\Seeders;

use App\Models\Etablissement;
use App\Models\Garanti;
use App\Models\ReglementationAutorisation;
use App\Models\SpecialiteAlerte;
use App\Models\SpecialiteEtablissement;
use Illuminate\Database\Seeder;

class ReglementationSpecialiteGarantiAutorisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $etablissements = Etablissement::get();
        for ($i = 0; $i < count($etablissements); $i++) {
            $etablissement
                = $etablissements[$i];

            ReglementationAutorisation::create(
                [
                    "authorisation_service" => ($i == 2 || $i == 4) ? false : true,
                    "etablissement_id" =>  $etablissement->id
                ]
            );
            Garanti::create(
                [
                    "arcce" => ($i == 0 || $i == 3 || $i == 5) ? true : false,

                    "extra" => "Aucun",
                    "etablissement_id" =>  $etablissement->id
                ]
            );
            if ($i == 0) {
                $data = [1, 2, 3, 4, 5, 79, 59];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 1) {
                $data = [1, 2, 18, 87, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 2) {
                $data = [4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 3) {
                $data = [2, 13, 4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 4) {
                $data = [2, 10, 4, 15];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 5) {
                $data = [11, 4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 6) {
                $data = [13, 15, 7, 4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
        }
    }
}
