<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
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

        $etablissements = $this->etablissementService->index($request);

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

    public function subScribeAlerte(Request $request, $etablissement_id)
    {
        // $this->validate($request, [
        //     'etablissement_id' => 'required|integer',
        // ]);
        $etablissement = Etablissement::find($etablissement_id);

        $etablissement->status
            = !$etablissement->status;
        $etablissement->save();
        return $this->successResponse($etablissement);
    }
    public function storeSpeciality(Request $request)
    {
        $etablissement = $this->etablissementService->storeSpeciality($request);

        return $this->successResponse($etablissement);
    }
    public function deletteEtablissmentSpeciality(Request $request)
    {
        $etablissement = $this->etablissementService->deletteEtablissmentSpeciality($request);

        return $this->successResponse($etablissement);
    }

    public function storeLocation(Request $request)
    {
        $etablissement = $this->etablissementService->storeLocation($request);

        return $this->successResponse($etablissement);
    }
    public function show($etablissement_id)
    {
        $etablissement = Etablissement::find($etablissement_id)/* ->load(['localisation', 'specialites', 'Notation']) */;

        return $this->successResponse($etablissement);
    }
}
