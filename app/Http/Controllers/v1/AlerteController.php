<?php

namespace App\Http\Controllers\v1;

use App\Models\Categorie;
use App\Models\CategorieEtablissement;
use App\Models\SpecialiteEtablissement;
use App\Services\NotationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alerte;
use App\Models\Etablissement;
use App\Models\NotationPatient;
use App\Models\Patient;
use App\Models\Specialite;
use App\Services\AlerteService;
use Carbon\Carbon;
use Nette\Utils\DateTime;

class AlerteController extends Controller
{
    private $alerteService;

    public function __construct(AlerteService $alerteService)
    {
        $this->alerteService = $alerteService;
    }

    public function index(Request $request)
    {
        $size = $request->size ?? 25;
        $user_id = $request->user_id;
        $alertes = Alerte::query();
        if ($user_id != "") {
            $alertes = $alertes->where('user_id', $user_id)->with(['etablissement'])->whereNotNull('etablissement_id');
        }
        $alertes = $alertes->with(['etablissement.localisation', 'specialites'])->latest()->paginate($size);
        return $this->successResponse($alertes);
    }
    public function historyInfoUserAlert($user_id)
    {
        $alerte = Alerte::where('user_id', $user_id)->latest()->first();
        return $this->successResponse($alerte != null ? ['sexe' => $alerte->sexe_user, 'poids' => $alerte->poids_user, 'taille' => $alerte->taille_user, 'birthDay' => $alerte->birthday_user] : null);
    }
   
    /**
     * Show the form for creating a new resource or update if existing .
     *
     * @return        \Illuminate\Http\JsonResponse

     */
    public function store(Request $request)
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
        $this->validate($request, [
            'user_id' => 'required|integer',
            'level_urgence' => 'required|integer',
            'nom_user' => 'required',
            'speciality' => 'required',
            'email_user' => 'required',
            'ville_user' => 'required',
            'longitude_user' => 'required|numeric',
            'latitude_user' => 'required|numeric',
            'birthday_user' => 'required',
            'poids_user' => 'required|numeric',
            'taille_user' => 'required|numeric',
            'sexe_user' => 'required',
        ]);

        $level_urgence = $request['level_urgence'];
        $name_user = $request['nom_user'];
        $speciality = $request['speciality'];
        $ville_user = $request['ville_user'];
        $longitude = $request['longitude_user'];
        $latitude = $request['latitude_user'];
        $description = $request->all()['description'];
        $email_user = $request['email_user'];
        $user_id = $request['user_id'];
        $sexe_user = $request['sexe_user'];
        $taille_user = $request['taille_user'];

        $poids_user = $request['poids_user'];
        $birthday_user = $request['birthday_user'];
        $taille = $taille_user / 100;
        $BMI = $poids_user / $taille * $taille;

        // return response()->json(['data' => $birthday_user]);

        // Obtenir l'âge en années
        $age =  Carbon::parse($birthday_user)->age;
        // doit contenir la moyenne et l'etablissement

        // $etablissements = Etablissement::has('localisation', 'specialites', 'agendas')->get();

        $etablissements = Etablissement::whereNotNull('localisation_id')->get();
        // $etablissements = Etablissement::whereHas('localisation')
        //     ->whereHas('specialiteEtablissement')
        //     ->whereHas('AgendaEtablissement')
        //     ->with('localisation', 'specialites', 'agendas')
        //     ->get();

        $filter_etablissements = collect();
        // $moyenne = [];
        foreach ($etablissements  as $valeur) {
            $moyenne
                =
                // $pLevelUrgence * $level_urgence
                // + $pBMI * $this->alerteService->bmiGraduation($BMI)

                // + $pAge * $age
                // +
                $pNotation * $this->alerteService->getNote($valeur->id)
                + $pAutorisation_service * $this->alerteService->noteAutorisationService($valeur->id)
                + $pVille * $this->alerteService->ifEtablissementVille($ville_user, $valeur->id)
                + $pLocalisation * $this->alerteService->distanceEtablissementUser($latitude, $longitude, $valeur->id)

                + $pGarantie * $this->alerteService->noteGarantiEtablissement($valeur->id)

                + $pSpecialite * $this->alerteService->ifEtablissementSpeciality($speciality, $valeur->id);


            $etablissement = Etablissement::where('id', $valeur->id)
                ->with(['localisation', 'categories', /* 'specialites',  */ 'Notation', 'agendas'])->first();

            $etablissement->mville =  $pVille * $this->alerteService->ifEtablissementVille($ville_user, $valeur->id);
            $etablissement->authorisation =   $this->alerteService->noteAutorisationService($valeur->id) == 5;
            $etablissement->distance =  $this->alerteService->calculerDistance($latitude, $longitude, $valeur->localisation->latitude, $valeur->localisation->longitude);
            $etablissement->garanti =   $this->alerteService->noteGarantiEtablissement($valeur->id) ==  5;
            $etablissement->specialites_number =   count($this->alerteService->matchSpeciality($speciality, $valeur->id));
            $etablissement->specialites =    $this->alerteService->matchSpeciality($speciality, $valeur->id);
            $etablissement->moyenne = $moyenne;
            $filter_etablissements->push($etablissement);
        }

        /**
         *  Classer les établissement par ordre décroissant de moyenne
         */
        // $filter_etablissements = $filter_etablissements->sortByDesc('moyenne');
        $filter_etablissements = $filter_etablissements
            ->sortByDesc('moyenne')
            ->groupBy('moyenne')
            ->flatMap(function ($group) {
                return $group->sortBy('distance');
            });

        // $filter_etablissements = $filter_etablissements->sortByDesc('distance');
        $filter_etablissements = $filter_etablissements->values()->all();


        $alerte = Alerte::create([
            'user_id' => $user_id,
            'name_user' =>  $name_user,
            'birthday_user' =>  $birthday_user,
            'poids_user' =>  $poids_user,
            'taille_user' =>  $taille_user,
            'email_user' =>  $email_user,
            'niveau_urgence' =>  $level_urgence,
            'description' =>  $description,
            'ville' =>  $ville_user,
            'longitude' =>  $longitude,
            'latitude' =>  $latitude,
            'sexe_user' =>  $sexe_user,

        ]);

        $alerte->save();
        $alerte->specialites()->attach($speciality);
        $categorie = Categorie::get();
        return $this->successResponse(['data' => $filter_etablissements, 'categories' => $categorie, 'alert_id' => $alerte->id]);
    }
    public function subScribeAlerte(Request $request, $alerte)
    {
        $this->validate($request, [
            'etablissement_id' => 'required|integer',
        ]);
        $alerte = Alerte::find($alerte);
        $alerte->etablissement_id = $request->etablissement_id;
        $alerte->save();


        return $this->successResponse($alerte);
    }
    /**
     * Show the form for creating a new resource or update if existing .
     *
     * @return        \Illuminate\Http\JsonResponse

     */
    /* public function getListAlerte($user_id)
    {
        $listAlerte = $this->alerteService->getListAlerte($user_id);

        return $this->successResponse($listAlerte);
    } */
    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getNote($etablissement_id)
    {
        $note = $this->alerteService->getNote($etablissement_id);

        return $note;
    }
    public function update(Request $request, $alerte)
    {
    }

    public function delete($alerte)
    {
    }
}
