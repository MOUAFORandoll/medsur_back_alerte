<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\AgendaEtablissement;
use App\Models\Alerte;
use App\Models\Specialite;
use App\Services\EtablissementService;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Str;
use App\Models\Agenda;
use App\Models\Etablissement;
use App\Models\SpecialiteEtablissement;
use App\Models\Localisation;
use Illuminate\Http\Request;

class EtablissementController extends Controller
{

    private $etablissementService;

    public function __construct(EtablissementService $etablissementService)
    {
        $this->etablissementService = $etablissementService;
    }

    public function index(Request $request)
    {

        $size = $request->size ?? 25;
        $etablissements = Etablissement::with(['localisation', 'categories', /* 'specialites',  */ 'Notation', 'agendas'])
            ->latest()
            ->paginate($size);


        return $this->successResponse($etablissements);
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|string',
                'description' => 'required|string',
                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',

                'ville' => 'required|string',
                'speciality' => 'required',
                'user_id' => 'required',

            ]
        );
        $localisation =   Localisation::create([
            'longitude' =>
            $request['longitude'],
            'latitude' =>  $request['latitude'],
            'boite_postale' =>   $request['boite_postale'] ?? '',
            'pays' =>  $request['pays'] ?? 'Cameroun',
            'ville' =>  $request['ville'],
            'rue' =>  $request['rue'] ?? '',
            'description' => $request['description0'] ?? '',
        ]);
        $localisation->save();
        $etablissement = Etablissement::create([
            'name' => $request['name'],
            'name2' => $request->name2 ?? '',
            'siteweb' =>   $request['siteweb'] ?? '',
            'code' => Str::random(10) /*  $request['code'] */,
            'phone' =>  $request['phone'],
            'phone2' =>
            $request['phone2'] ?? '',
            'email' =>  $request['email'],
            'description' =>  $request['description'],
            'localisation_id' => $localisation->id,
            "user_id"
            => $request['user_id'],
            "status" => false

        ]);
        $etablissement->save();
        $speciality = $request['speciality'];
        foreach ($speciality as  $valeur) {

            $specialite = SpecialiteEtablissement::create([
                'specialite_id' => $valeur,

                'etablissement_id' => $etablissement->id
            ]);
            $specialite->save();
        }
        $agenda = $request['agenda'];

        foreach ($agenda as  $valeur) {


            $agenda =    AgendaEtablissement::create([
                'debut' =>
                $valeur[1],
                'fin' =>
                $valeur[2],
                'agenda_id' => $valeur[3],
                'etablissement_id' => $etablissement->id


            ]);


            $agenda->save();
        }

        return $this->successResponse($etablissement);
    }

    public function stateEtablissement($etablissement_id)
    {

        $etablissement = Etablissement::find($etablissement_id);

        $etablissement->status
            = !$etablissement->status;
        $etablissement->save();
        return $this->successResponse($etablissement);
    }

    public function updateSpeciality(Request $request, $etablissement_id)
    {

        $this->validate(
            $request,
            [
                'specialite_id' => 'required',


            ]
        );

        $etablissement = Etablissement::find($etablissement_id);

        if (!$etablissement || empty($request['specialite_id'])) {
            return response()->json(['status' => 'Renseigner les informations correctes']);
        }

        // foreach ($request['specialite_id'] as $specialite) {
        $specialiteExist = Specialite::find($request['specialite_id']);

        if ($specialiteExist) {
            $specialiteEtablissementExist = SpecialiteEtablissement::where('etablissement_id', $etablissement_id)
                ->where('specialite_id', $request['specialite_id'])
                ->exists();

            if (!$specialiteEtablissementExist) {
                SpecialiteEtablissement::create([
                    'etablissement_id' => $etablissement_id,
                    'specialite_id' => $request['specialite_id'],
                ]);
            }
            // }
        }

        return $this->show($etablissement_id);
    }
    public function removeEtablissmentSpeciality(Request $request, $etablissement_id)
    {

        // $this->validate(
        //     $request,
        //     [

        //         'specialite_id' => 'required',


        //     ]
        // );
        // $specialite_id = $request['specialite_id'];
        // $speciality = Specialite::find($specialite_id);


        // foreach ($speciality as  $valeur) {

        //     $SpecialiteEtablissement = SpecialiteEtablissement::where('etablissement_id',  $etablissement_id)
        //         ->where('specialite_id',  $valeur)
        //         ->first();



        //     $SpecialiteEtablissement->delete();
        // }


        $this->validate(
            $request,
            [
                'specialite_id' => 'required',
            ]
        );

        $specialite_id = $request['specialite_id'];
        $SpecialiteEtablissement = SpecialiteEtablissement::where('etablissement_id', $etablissement_id)
            ->where('specialite_id', $specialite_id)
            ->first();

        if ($SpecialiteEtablissement) {
            $SpecialiteEtablissement->delete();
            // $etablissement = Etablissement::find(
            //     $etablissement_id
            // );
        }




        return  $this->show($request['etablissement_id']);
    }

    public function storeLocation(Request $request)
    {


        $this->validate(
            $request,
            [

                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',
                'boite_postale' => 'required|string',
                'pays' => 'required|string',
                'ville' => 'required|string',
                'rue' => 'required|string',
                'description' => 'required|string',
                'etablissement_id' => 'required|integer',

            ]
        );
        $etablissement = Etablissement::find($request['etablissement_id']);

        if (!$etablissement) {
            return response()->json(['status' => false]);
        }

        $localisation = $etablissement->localisation;

        if ($localisation && $localisation->id != 0 && $localisation->id != null) {
            $localisation->update([
                'longitude' => $request['longitude'],
                'latitude' => $request['latitude'],
                'boite_postale' => $request['boite_postale'],
                'pays' => $request['pays'],
                'ville' => $request['ville'],
                'rue' => $request['rue'],
                'description' => $request['description'],
            ]);
        } else {
            $localisation = Localisation::create([
                'longitude' => $request['longitude'],
                'latitude' => $request['latitude'],
                'boite_postale' => $request['boite_postale'],
                'pays' => $request['pays'],
                'ville' => $request['ville'],
                'rue' => $request['rue'],
                'description' => $request['description'],
            ]);

            $etablissement->localisation_id = $localisation->id;
        }

        $etablissement->save();


        $etablissement->save();
        $localisation->save();



        return $this->show($etablissement->id);
    }
    public function show($etablissement_id)
    {
        $etablissement = Etablissement::find($etablissement_id)->load(['localisation', 'categories',   'specialites',   'Notation', 'agendas']);

        // $etablissement = Etablissement::with(['localisation', 'categories', 'specialites', 'Notation', 'agendas'])
        // ->whereHas('localisation', function ($query) {
        //     $query->whereNull('localisation.deleted_at');
        // })
        //     ->whereHas('categories', function ($query) {
        //         $query->whereNull('categories.deleted_at');
        //     })
        //     ->whereHas('specialites', function ($query) {
        //         $query->whereNull('specialites.deleted_at');
        //     })
        //     ->whereHas('Notation', function ($query) {
        //         $query->whereNull('notation.deleted_at');
        //     })
        //     ->whereHas('agendas', function ($query) {
        //         $query->whereNull('agendas.deleted_at');
        //     })
        //     ->find($etablissement_id);
        $etablissement->nmbre_alerte = $this->etablissementService->nombrealerteEtablissement($etablissement->id);

        return $this->successResponse($etablissement);
    }
    public function showEtabliseementUser($user_id)
    {
        $etablissement = Etablissement::where('user_id', $user_id)
            ->with(['localisation', 'categories',   'specialites',   'Notation', 'agendas'])->get()->last();
        $etablissement->nmbre_alerte = $this->etablissementService->nombrealerteEtablissement($etablissement->id);

        return $this->successResponse($etablissement);
    }

    public function showAlertEtablissement(Request $request)
    {
        $size = $request->size ?? 25;
        $etablissement_id = $request->etablissement_id;
        $alertes = Alerte::query();
        if ($etablissement_id != "") {
            $alertes = $alertes->where('etablissement_id', $etablissement_id)->with(['etablissement'])->whereNotNull('etablissement_id');
        }
        $alertes = $alertes->with(['etablissement.localisation', 'specialites'])->latest()->paginate($size);
        return $this->successResponse($alertes);
    }
}
