<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
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
                'pays' => 'required|string',
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
            'pays' =>  $request['pays'],
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

                'etablissement_id' => $localisation->id
            ]);
            $specialite->save();
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
                'speciality' => 'required|array',


            ]
        );

        $etablissement = Etablissement::where('id', $etablissement_id)
            ->get();

        if (
            count($etablissement) == 0 ||
            count($request['speciality']) == 0
        ) {
            return response()->json(['status' => 'Renseigner les informations correctes']);
        } else {
            foreach ($request['speciality'] as $specialite) {
                $specialiteExist = Specialite::where('id', $specialite)
                    ->get();
                if (
                    count($specialiteExist) != 0
                ) {


                    $SpecialiteEtablissement = SpecialiteEtablissement::where('etablissement_id', $request['etablissement_id'])
                        ->where('specialite_id', $specialite)
                        ->get();

                    if (
                        count($SpecialiteEtablissement) == 0
                    ) {

                        $newLSE =   SpecialiteEtablissement::create([
                            'etablissement_id' =>
                            $etablissement_id,
                            'specialite_id' =>  $specialite,

                        ]);


                        $newLSE->save();
                    }
                }
            }
        }
        return $this->show($etablissement_id);
    }
    public function removeEtablissmentSpeciality(Request $request, $etablissement_id)
    {

        $this->validate(
            $request,
            [

                'speciality' => 'required',


            ]
        );
        $speciality = $request['speciality'];
        foreach ($speciality as  $valeur) {

            $SpecialiteEtablissement = SpecialiteEtablissement::where('etablissement_id',  $etablissement_id)
                ->where('specialite_id',  $valeur)
                ->first();



            $SpecialiteEtablissement->delete();
        }





        
        return $this->show($request['etablissement_id']);
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
        $etablissement = Etablissement::find($etablissement_id)->load(['localisation', 'categories',   'specialites',   'Notation', 'agendas']) ;

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
        return $this->successResponse($etablissement);
    }
}
