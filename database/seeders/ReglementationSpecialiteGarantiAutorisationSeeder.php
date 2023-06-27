<?php

namespace Database\Seeders;

use App\Models\CategorieEtablissement;
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

            // ReglementationAutorisation::create(
            //     [
            //         "authorisation_service" => ($i == 0 || $i == 2 || $i == 4) ? false : true,
            //         "etablissement_id" =>  $etablissement->id
            //     ]
            // );
            // Garanti::create(
            //     [
            //         "arcce" => ($i == 0 || $i == 3 || $i == 5) ? false : true,

            //         "extra" => "Aucun",
            //         "etablissement_id" =>  $etablissement->id
            //     ]
            // );
            if ($i == 0) {

                // ReglementationAutorisation::create(
                //     [
                //         "authorisation_service" =>   true,
                //         "etablissement_id" =>  $etablissement->id
                //     ]
                // );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [1, 2, 3, 4, 5, 79, 59];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [1, 2, 3];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 1) {

                ReglementationAutorisation::create(
                    [
                        "authorisation_service" =>   true,
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [1, 2, 18, 87, 5, 49, 46, 13, 15, 7, 4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [2, 3];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 2) {
                ReglementationAutorisation::create(
                    [
                        "authorisation_service" =>   true,
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [1, 2, 4];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 3) {
                ReglementationAutorisation::create(
                    [
                        "authorisation_service" =>   true,
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [2, 13, 4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [1,];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 4) {
                // ReglementationAutorisation::create(
                //     [
                //         "authorisation_service" =>   true,
                //         "etablissement_id" =>  $etablissement->id
                //     ]
                // );
                // Garanti::create(
                //     [
                //         "arcce" =>  false,

                //         "extra" => "Aucun",
                //         "etablissement_id" =>  $etablissement->id
                //     ]
                // );
                $data = [2, 10, 4, 15];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [3];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 5) {
                // ReglementationAutorisation::create(
                //     [
                //         "authorisation_service" =>   true,
                //         "etablissement_id" =>  $etablissement->id
                //     ]
                // );
                // Garanti::create(
                //     [
                //         "arcce" =>  false,

                //         "extra" => "Aucun",
                //         "etablissement_id" =>  $etablissement->id
                //     ]
                // );
                $data = [11, 4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [1,  4];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 6) {
                ReglementationAutorisation::create(
                    [
                        "authorisation_service" =>   true,
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [13, 15, 7, 4, 5];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [2, 4];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 7) {
                ReglementationAutorisation::create(
                    [
                        "authorisation_service" =>   true,
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [49, 46];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [3];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 8) {
                ReglementationAutorisation::create(
                    [
                        "authorisation_service" =>   true,
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [49, 27, 46];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [1];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
            if ($i == 9) {
                ReglementationAutorisation::create(
                    [
                        "authorisation_service" =>   true,
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                Garanti::create(
                    [
                        "arcce" =>  false,

                        "extra" => "Aucun",
                        "etablissement_id" =>  $etablissement->id
                    ]
                );
                $data = [49];
                for ($j = 0; $j < count($data); $j++) {
                    SpecialiteEtablissement::create(
                        [
                            "specialite_id" => $data[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
                $dataCategorie = [1, 2, 3, 4];
                for ($j = 0; $j < count($dataCategorie); $j++) {
                    CategorieEtablissement::create(
                        [
                            "categorie_id" => $dataCategorie[$j],
                            "etablissement_id" =>  $etablissement->id
                        ]
                    );
                }
            }
        }
    }
}
