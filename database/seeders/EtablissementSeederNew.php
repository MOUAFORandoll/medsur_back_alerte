<?php

namespace Database\Seeders;

use App\Models\Etablissement;
use App\Models\Localisation;
use Illuminate\Database\Seeder;

class  EtablissementSeederNew extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $localisations = [
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Douala",
                "rue" => "Aucune",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. ",
                "longitude" => "9.6998770431678",
                "latitude" => "4.0418003231239"
            ],
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Yaoundé",
                "rue" => "Aucune",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" => "11.546031336426",
                "latitude" => "3.8570371050074"
            ],
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Yaoundé",
                "rue" => "Aucune",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" => "11.538896536987425",
                "latitude" => "3.880851297762467",

            ],
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Yaoundé",
                "rue" => "Yaoundé",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" => " 11.516658236987354",
                "latitude" => "3.8722976960242024"
            ],


            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Douala",
                "rue" => "Japoma",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" => 9.73148269465842,
                "latitude" => 4.046984441811917
            ],

            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Douala",
                "rue" => " 5147 Ave Japoma",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" => 9.704083209999917,
                "latitude" => 4.058573740359629,
            ],
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Douala",
                "rue" => "Bonaberi ,DOUALA",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" => 9.672658606304942,
                "latitude" => 4.086131838173032

            ]
        ];

        $datas = [
            [
                "name" => "Yaoundé",
                "name2" => "HRM",
                "code" => "677 76 51 43",
                "phone" => "",
                "phone2" => "",
                "email" => "",
                "siteweb" => "",
                "localisation_id" => 0,
                "description" => ""
            ],
            [
                "name" => "Yaoundé",
                "name2" => "HGOPY",
                "code" => "699 25 88 52",
                "phone" => "",
                "phone2" => "",
                "email" => "",
                "siteweb" => "",
                "localisation_id" => 0,
                "description" => ""
            ],
            [
                "name" => "Yaoundé",
                "name2" => "CMC Essos",
                "code" => "69992 24 77/677 68 28 91",
                "phone" => "",
                "phone2" => "",
                "email" => "",
                "siteweb" => "",
                "localisation_id" => 0,
                "description" => ""
            ],
            [
                "name" => "Sangmélima",
                "name2" => "HRéf",
                "code" => "699 65 82 16",
                "phone" => "",
                "phone2" => "",
                "email" => "",
                "siteweb" => "",
                "localisation_id" => 0,
                "description" => ""
            ],
            [
                "name" => "Anesthésie/réa",
                "name2" => "HGD",
                "code" => "699 98 14 45",
                "phone" => "",
                "phone2" => "",
                "email" => "",
                "siteweb" => "",
                "localisation_id" => 0,
                "description" => ""
            ],
            // Ajoutez les autres objets ici
        ];

        foreach ($localisations as $localisation) {
            Localisation::create(
                $localisation
            );
        }
        foreach ($datas as $etablissement) {
            Etablissement::create(
                $etablissement
            );
        }
        // $etablissements = Etablissement::factory()->count(50)->create();
    }
}




