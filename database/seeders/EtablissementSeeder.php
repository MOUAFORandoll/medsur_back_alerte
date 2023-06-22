<?php

namespace Database\Seeders;

use App\Models\Etablissement;
use App\Models\Localisation;
use Illuminate\Database\Seeder;

class  EtablissementSeeder extends Seeder
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

            ],
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Yaounde",
                "rue" => "Obobogo ,Yaounde",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" => 11.503743699598468,
                "latitude" =>  3.8284749285193658,
            ],
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Douala",
                "rue" => "Bonamoussadi ,DOUALA",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" =>  9.72541001099492,
                "latitude" =>   4.0836531316119045,
            ],
            [

                "boite_postale" => "Aucune",
                "pays" => "Cameroun",
                "ville" => "Douala",
                "rue" => "Bonamoussadi ,DOUALA",
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",
                "longitude" =>  9.70114329750195,
                "latitude" =>     4.052073833358384,
            ]
        ];

        $datas = [
            [

                "name" => "CLINIQUE BON SECOURS",
                "name2" => "CLINIQUE BON SECOURS",
                "code" => "237",
                "phone" => "699109851",
                "phone2" => "699109851",
                "email" => "test@test.com",
                "siteweb" => "www.test.com",
                "localisation_id" => 1,

                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            
            ],
            [
                "name" => "FONDATION MEDICALE JOSEPH PERRAIN",
                "name2" => "FONDATION MEDICALE JOSEPH PERRAIN",
                "code" => "237",
                "phone" => "699109851",
                "phone2" => "699109851",
                "email" => "test@test.com",
                "siteweb" => "www.test.com",
                "localisation_id" => 2,

                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",


            ],
            [
                "name" => "Pharmacie Le Bon Berger",
                "name2" => "Pharmacie Le Bon Berger",
                "code" => "237",
                "phone" => "242606777",
                "phone2" => "242606777",
                "email" => "test@test.com",
                "siteweb" => "www.test.com",
                "localisation_id" => 3,

                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ],
            [

                "name" => "CABINET MÉDICAL DU DR NKOULOU - POLYCLINIQUE DE LA CITÉ",
                "name2" => "CABINET MÉDICAL DU DR NKOULOU - POLYCLINIQUE DE LA CITÉ",
                "code" => "237",
                "phone" => "699109851",
                "phone2" => "699109851",
                "email" => "test@test.com",
                "siteweb" => "www.test.com",
                "localisation_id" => 4,

                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ],
            [
                "name" => "CLINIQUE LA  REGENESCENCE",
                "name2" => "CLINIQUE LA  REGENESCENCE",
                "code" => "237",
                "phone" => "699888953",
                "phone2" => "699888953",
                "email" => "test@test.com",
                "siteweb" => "www.test.com",
                "localisation_id" => 5,

                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ],

            [
                "name" => "CLINIQUE L'OLIVERAIE",
                "name2" => "CLINIQUE L'OLIVERAIE",
                "code" => "237",
                "phone" => "2 33 42 99 08",
                "phone2" => "2 33 43 36 50",
                "email" => "clinicoliveraie@yahoo.fr",
                "siteweb" => "www.test.com",
                "localisation_id" => 6,

                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ],
            [
                "name" => "CLINIQUE NDASSA",
                "name2" => "CLINIQUE NDASSA",
                "code" => "237",
                "phone" => "699919038",
                "phone2" => "233 12 10 69",
                "email" => "clinicoliveraie@yahoo.fr",
                "siteweb" => "www.test.com",
                "localisation_id" => 7,

                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ], [
                "name" => "Ad Lucem",
                "name2" => "Ad Lucem",
                "code" => "237",
                "phone" => "699 92 88 11",
                "phone2" => "699 92 88 11",
                "email" => "adlucem@yahoo.fr",
                "siteweb" => "www.test.com",
                "localisation_id" => 8,
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ], [
                "name" => "Ad Lucem Dla",
                "name2" => "Ad Lucem",
                "code" => "237",
                "phone" => "233473725",
                "phone2" => "233473725",
                "email" => "adlucem@yahoo.fr",
                "siteweb" => "www.test.com",
                "localisation_id" => 9,
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ], [
                "name" => "Centre Médico-pédiatrique Beau Bébé, Douala",
                "name2" => "Centre Médico-pédiatrique Beau Bébé, Douala",
                "code" => "237",
                "phone" => "699 86 63 72",
                "phone2" => "699 86 63 72",
                "email" => "adlucem@yahoo.fr",
                "siteweb" => "www.test.com",
                "localisation_id" => 10,
                "description" => "Sint consequat dolor labore laborum velit mollit aliqua reprehenderit. Non esse duis adipisicing officia pariatur. Labore exercitation consequat qui culpa. Ullamco quis minim aliquip occaecat ex. Reprehenderit in id enim consequat magna non excepteur nulla. Adipisicing tempor sunt exercitation dolore laborum minim aliqua est.",

            ],

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
