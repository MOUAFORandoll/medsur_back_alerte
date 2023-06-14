<?php

namespace Database\Seeders;

use App\Models\Specialite;
use Illuminate\Database\Seeder;

class SpecialiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialites = [
            "allergologie",
            "anatomo-pathologie",
            "andrologie",
            "anesthésiologie",
            "anesthésie-réanimation",
            "biologie médicale",
            "cardiologie",
            "chirurgie cardiaque",
            "chirurgie plastique",
            "chirurgie reconstructrice", "chirurgie esthétique",
            "chirurgie générale",
            "chirurgie gynécologique",
            "chirurgie maxillo-faciale",
            "chirurgie oculaire",
            "chirurgie orale",
            "chirurgie pédiatrique",
            "chirurgie thoracique",
            "chirurgie vasculaire",
            "chirurgie viscérale",
            "neurochirurgie",
            "dermatologie",
            "dermatologie-vénérologie",
            "endocrinologie",
            "gastro-entérologie",
            "gériatrie",
            "gynécologie-obstétrique",
            "hématologie",
            "hépatologie",
            "immunologie",
            "infectiologie",
            "médecine aiguë",
            "médecine dentaire",
            "médecine du travail",
            "médecine d'urgence",
            "médecine générale",
            "médecine interne",
            "médecine nucléaire",
            "médecine physique et réadaptation",
            "médecine préventive",
            "néonatologie",
            "neurologie",
            "obstétrique ",
            "odontologie",
            "oncologie",
            "ophtalmologie",
            "orthopédie",
            "oto-rhino-laryngologie",
            "pédiatrie",
            "pneumologie",
            "podologie",
            "psychiatrie adulte",
            "psychiatrie infanto-juvénile",
            "radiologie",
            "radiothérapie",
            "rhumatologie",
            "stomatologie",
            "urologie",
            "pharmacie d'officine",
            "pharmacie-biologie",
            "pharmacie d’hôpital",
            "pharmacie industrielle",
            "pharmacie grossiste répartiteur",
            "pharmacie inspecteur de la santé publique",
            "soins aide-soignant",
            "diététique",
            "ergothérapie",
            "étiopathie",
            "hydrothérapie",
            "soins-infirmier",
            "massage - kinésithérapie",
            "orthésiste-orthopédie",
            "orthoptie",
            "orthoptiste",
            "ostéopathie - chiropraxie",
            "pédicurie - podologie",
            "podo - orthésiste",
            "psychomotricité",
            "technique en analyses biomédicales",
            "Psychologie médicale",
            "assistance dentaire",
            "audioprothésiste",
            "auxiliaire de puériculture",
            "manipulation en électroradiologie médicale",
            "monteur vendeur en optique - lunetterie",
            "optique - lunetierie",
            "préparation en pharmacie",
            "prothésiste dentaire",
            "psychomotricité",
            "radiophysiquen en radiothérapie",
            "ambulance"

        ];

        foreach ($specialites as $specialite) {
            Specialite::create(['libelle' => ucfirst($specialite)]);
        }
    }
}
