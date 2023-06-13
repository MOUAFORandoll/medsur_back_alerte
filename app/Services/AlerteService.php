<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\AgendaEtablissement;
use App\Models\Alerte;
use App\Models\Garanti;
use App\Models\SpecialiteAlerte;
use App\Models\SpecialiteEtablissement;
use App\Models\ReglementationAutorisation;
use App\Models\Specialite;
use App\Services\NotationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use App\Models\Notation;
use App\Models\Patient;
use Illuminate\Validation\ValidationException;
use Nette\Utils\DateTime;

class AlerteService
{


    private $NotationService;

    public function __construct(NotationService $NotationService)
    {
        $this->NotationService = $NotationService;
    }

    public function index(Request $request)
    {
        $size = $request->size ?? 25;
        $notations = Notation::latest()->paginate($size);

        return $notations;
    }

    public function getHistoryInfoAlert($user_id)
    {
    }

    public function newAlerte(Request $request)
    {

        $pBMI = 1;
        $pAge = 1;
        $pVille = 1;
        $pSexe = 1;
        $pLevelUrgence = 1;
        $pGarantie = 1;
        $pSpecialite = 1;
        $pAutorisation_creation = 1;
        $pAutorisation_ouverture = 1;
        $pAutorisation_service = 1;

        $pNotation = 1;
        $pLocalisation = 1;

        try {
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'level_urgence' => 'required|integer',
                'nom_user' => 'required',
                'speciality' => 'required',
                'phone_user' => 'required',
                'birthday_user' => 'required',
                'poids_user' => 'required|numeric',
                'taille_user' => 'required|numeric',
                'email_user' => 'required',
                'ville_user' => 'required',
                'sexe_user' => 'required',
                'longitude_user' => 'required|numeric',
                'latitude_user' => 'required|numeric',



            ]);

            $level_urgence = $validatedData['level_urgence'];
            $name_user = $validatedData['nom_user'];
            $phone_user = $validatedData['phone_user'];
            $speciality = $validatedData['speciality'];
            $poids_user = $validatedData['poids_user'];
            $birthday_user = $validatedData['birthday_user'];
            $ville_user = $validatedData['ville_user'];
            $taille_user = $validatedData['taille_user'];
            $sexe_user = $validatedData['sexe_user'];
            $longitude = $validatedData['longitude_user'];
            $latitude = $validatedData['latitude_user'];
            $description
                = $request->toArray()['description'];
            $email_user = $validatedData['email_user'];
            $user_id = $validatedData['user_id'];
            $BMI =
                $poids_user / ($taille_user * $taille_user);

            // return response()->json(['data' => $this->distanceEtablissementUser($latitude, $longitude, 100)]);
            // Obtenir la date actuelle
            $dateActuelle = new DateTime();

            // Créer un objet DateTime à partir de la date de naissance
            $naissance = new DateTime($birthday_user);

            // Calculer la différence entre les deux dates
            $diff = $dateActuelle->diff($naissance);

            // Obtenir l'âge en années
            $age = $diff->y;
            // doit contenir la moyenne et l'etablissement
            $datas = [];
            $etablissements = Etablissement::whereNotNull('localisation_id')->get();


            foreach ($etablissements  as $valeur) {
                $moyenne
                    =
                    $pLevelUrgence * $level_urgence
                    + $pBMI  *  $BMI

                    + $pAge *  $age
                    + $pNotation *  $this->getNote($valeur->id)
                    // + $pAutorisation_creation *    $this->noteAutorisationCreation($valeur->id)
                    // + $pAutorisation_ouverture *   $this->noteAutorisationOuverture($valeur->id)
                    + $pAutorisation_service * $this->noteAutorisationService($valeur->id)
                    + $pVille * $this->ifEtablissementVille($ville_user, $valeur->id)
                    + $pLocalisation * $this->distanceEtablissementUser($latitude, $longitude, $valeur->id)


                    + $pSpecialite * $this->ifEtablissementSpeciality($speciality, $valeur->id)
                    + $pGarantie * $this->noteGarantiEtablissement($valeur->id);
                $datas[] = [$moyenne, $valeur->id];
            }

            usort($datas, function ($a, $b) {
                return $a[0] <=> $b[0];
            });
            $final = [];

            // Afficher la liste triée
            foreach ($datas as $element) {

                $etablissement = Etablissement::where('id', $element[1])
                    ->with(['localisation', 'SpecialiteEtablissement', 'Notation'])
                    ->first();
                $agenda = $this->getAgendaEtablissement($etablissement->id);
                $final[] = [
                    "id" =>   $etablissement->id,
                    "name" =>   $etablissement->name,
                    "agenda" => $agenda,
                    "siteweb" =>
                    $etablissement->siteweb ?? '',
                    "phone" =>   $etablissement->phone,
                    "phone2" =>   $etablissement->phone2,
                    "email" =>   $etablissement->email,
                    "description" =>   $etablissement->description,
                    'localisation' =>  $etablissement->localisation
                ];
            }
            $alerte =   Alerte::create([
                'user_id' => $user_id,
                'name_user' =>  $name_user,
                'phone_user' =>  $phone_user,
                'birthday_user' =>  $birthday_user,
                'poids_user' =>  $poids_user,
                'taille_user' =>  $taille_user,
                'email_user' =>  $email_user,
                // 'etablissement_id' =>  $validatedData['etablissement_id'],
                'niveau_urgence' =>  $level_urgence,
                'description' =>  $description,
                'ville' =>  $ville_user,
                'longitude' =>  $longitude,
                'latitude' =>  $latitude,
                'sexe_user' =>  $sexe_user,

            ]);

            $alerte->save();
            $this->addSpecialiteAlerte($speciality,  $alerte->id);
            //  dd($final);
            return ['data' => array_reverse($final), 'alert_id' => $alerte->id];
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    /**
     * Show the form for creating a new resource or update if existing .
     *
     * @return        \Illuminate\Http\JsonResponse

     */
    public function subScribeAlerte(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'alert_id' => 'required|integer',
                'etablissement_id' => 'required|integer',



            ]);

            $alert_id = $validatedData['alert_id'];
            $etablissement_id = $validatedData['etablissement_id'];

            $alerte = Alerte::where('id', $alert_id)
                ->first();
            $alerte
                ->etablissement_id
                =  $etablissement_id;

            $alerte->save();

            return $alerte;
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    public function addSpecialiteAlerte($specialite, int  $alerte)
    {

        foreach ($specialite as $specialite_id) {
            $SpecialiteAlerte =   SpecialiteAlerte::create([

                "specialite_id"  => $specialite_id,
                "alerte_id"  => $alerte


            ]);

            $SpecialiteAlerte->save();
        }
    }
    /**
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getListAlerte($user_id)
    {


        try {
            // $validatedData = $request->validate([
            //     'user_id' => 'required|integer',
            // ]);
            
            // $user_id = $validatedData['user_id'];

            $listAlerte = Alerte::where('user_id', $user_id)
                ->whereNotNull('etablissement_id')
                ->with(['etablissement'])

                ->get();
            $final = [];


            foreach ($listAlerte as $alert) {
                $etablissement  = $this->getEtablissement($alert->etablissement_id);
                if ($etablissement != null) {
                    $final[] = [
                        "id" =>   $alert->id,

                        'name_user' =>  $alert->name_user,
                        'phone_user' =>  $alert->phone_user,
                        'birthday_user' =>  $alert->birthday_user,
                        'poids_user' =>  $alert->poids_user,
                        'taille_user' =>  $alert->taille_user,
                        'email_user' =>  $alert->email_user,
                        'etablissement_id' =>  $alert->etablissement_id,
                        'etablissement ' => $etablissement,
                        'niveau_urgence' =>  $alert->niveau_urgence,
                        'description' =>  $alert->description,
                        'ville' =>  $alert->ville,
                        'longitude' =>  $alert->longitude,
                        'latitude' =>  $alert->latitude,
                        'sexe_user' =>  $alert->sexe_user,
                        'created_at' =>  $alert->created_at,
                        'updated_at' =>  $alert->updated_at,
                    ];
                }
            }
            return $final;
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    /**
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getNote(int $etablissement_id)
    {


        $notE =   $this->NotationService->getNote($etablissement_id);
        // Initialisation de la somme
        $somme = 0;

        // Parcourir les clés et ajouter les valeurs à la somme
        foreach ($notE as $cle => $valeur) {
            $somme += $valeur;
        }
        return count($notE) != 0 ? $somme / count($notE) : 0;
    }

    public function ifEtablissementSpeciality($specialite, int  $etablissement_id)
    {
        $point = 0;


        foreach ($specialite as  $valeur) {
            $exist = SpecialiteEtablissement::where('specialite_id', $valeur)
                ->where('etablissement_id', $etablissement_id)
                ->get();
            $point += count($exist)  !=  0 ? 5 : 0;
        }


        return $point;
    }
    public function bmiGraduation($bmi)
    {
        if (
            0 <= $bmi &&
            $bmi <= 18.4
        ) {
            return 0;
        } else    if (
            18.5 <= $bmi &&
            $bmi <= 24.9
        ) {
            return 1;
        } else    if (
            25 <= $bmi &&
            $bmi <= 29.9
        ) {
            return 2;
        } else    if (
            30 <= $bmi &&
            $bmi <= 34.9
        ) {
            return 3;
        } else    if (
            35 <= $bmi &&
            $bmi <= 39.9
        ) {
            return 4;
        } else    if (
            40 <= $bmi
        ) {
            return 5;
        } else {
            return 0;
        }
    }
    // public function noteAutorisationCreation(int  $etablissement_id)
    // {
    //     $exist = ReglementationAutorisation::where(
    //         "etablissement_id",
    //         $etablissement_id
    //     )->get();

    //     return count($exist) == 0 ? 0 : ($exist->authorisation_creation ? 5 : 0);
    // }
    // public function noteAutorisationOuverture(int  $etablissement_id)
    // {
    //     $exist = ReglementationAutorisation::where(
    //         "etablissement_id",
    //         $etablissement_id
    //     )->get();

    //     return count($exist) == 0 ? 0 : ($exist->authorisation_ouverture ? 5 : 0);
    // }
    public function noteAutorisationService(int  $etablissement_id)
    {
        $exist = ReglementationAutorisation::where(
            "etablissement_id",
            $etablissement_id
        )->get();

        return count($exist) == 0 ? 0 : ($exist->first()->authorisation_service == true ? 5 : 0);
    }
    public function ifEtablissementVille($ville, int  $etablissement_id)
    {
        $exist = Etablissement::where(
            "id",
            $etablissement_id
        )
            ->with(['localisation',])
            ->first();
        return    $exist == null ? 0 : ($exist['localisation'] == null ? 0 : (strtolower($exist['localisation']["ville"]) == strtolower($ville) ? 5 : 0));
    }
    public function noteGarantiEtablissement(int  $etablissement_id)
    {
        $exist = Garanti::where(
            "etablissement_id",
            $etablissement_id
        )->get();

        return  count($exist) == 0 ? 0 :  5;
    }
    public function getEtablissement(int  $etablissement_id)
    {
        $exist =  Etablissement::where(
            "id",
            $etablissement_id
        )->first();

        return  $exist;
    }
    public function getAgendaEtablissement(int  $etablissement_id)
    {
        $dataF = [];
        $agenda = Agenda::get();

        foreach ($agenda as $ag) {
            $agEta = AgendaEtablissement::where(
                "etablissement_id",
                $etablissement_id
            )
                ->where("agenda_id", $ag->id)->first();
            if ($agEta  != null) {
                $dataF[] = [
                    'libelle' => $ag->libelle,
                    'debut' => $agEta->debut,
                    'fin' => $agEta->fin,
                ];
            }
        }




        return  $dataF;
    }
    public function distanceEtablissementUser($latUser, $lonUser, int  $etablissement_id)
    {
        $exist = Etablissement::where(
            "id",
            $etablissement_id
        )
            ->with(['localisation',])
            ->first();
        // return $exist != null;
        if ($exist != null) {
            if ($exist->localisation != null) {
                $latEtablissment
                    = $exist->localisation->latitude;
                $lonEtablissment
                    = $exist->localisation->longitude;
                return  $this->calculerDistance($latUser, $lonUser, $latEtablissment, $lonEtablissment);
            } else {
                return  0;
            }
        } else {
            return  0;
        }
    }
    function calculerDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Rayon moyen de la Terre en kilomètres

        // Conversion des degrés en radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Calcul des différences de latitude et de longitude
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;

        // Calcul de la distance sur une sphère
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $this->distanceGraduation($distance);
    }

    public function distanceGraduation($distance)
    {
        if (
            0 <= $distance &&
            $distance <= 20
        ) {
            return 5;
        } else    if (
            21 <= $distance &&
            $distance <= 40
        ) {
            return 4;
        } else    if (
            41 <= $distance &&
            $distance <= 60
        ) {
            return 3;
        } else    if (
            61 <= $distance &&
            $distance <= 80
        ) {
            return 2;
        } else    if (
            81 <= $distance &&
            $distance <= 100
        ) {
            return 1;
        } else    if (
            101 <= $distance
        ) {
            return 0;
        } else {
            return 0;
        }
    }
}
