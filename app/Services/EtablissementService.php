<?php

namespace App\Services;

use App\Models\Agenda;
use App\Models\Etablissement;
use App\Models\SpecialiteEtablissement;
use App\Models\Localisation;
use Illuminate\Http\Request;
use App\Models\NotationPatient;
use App\Models\Patient;
use App\Models\Specialite;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class EtablissementService
{

    public function __construct()
    {
    }


    public function index(Request $request)
    {
        $size = $request->size ?? 25;
        $etablissements = Etablissement::latest()->paginate($size);
        return $etablissements;
    }

    public function show($etablissement_id)
    {
    }

    /**
     * Show the form for creating a new resource .
     *
     * @return        \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

    }
    /**
     * add or update location.
     *
     * @return        \Illuminate\Http\JsonResponse

     */
    public function storeLocation(Request $request)
    {

        try {
            $validatedData = $request->validate([

                'longitude' => 'required|numeric',
                'latitude' => 'required|numeric',
                'boite_postale' => 'required|string',
                'pays' => 'required|string',
                'ville' => 'required|string',
                'rue' => 'required|string',
                'description' => 'required|string',
                'etablissement_id' => 'required|integer',
              
            ]);
            $etablissementExist = Etablissement::where('id', $validatedData['etablissement_id'])
                ->get();
            if (count($etablissementExist) == 0) {
                return response()->json(['status' => false]);
            } else {
                $etablissement  = Etablissement::where('id', $validatedData['etablissement_id'])
                    ->first();
                if ($etablissement->localisation_id == 0 || $etablissement->localisation_id == null) {
                    $localisation =   Localisation::create([
                        'longitude' =>
                        $validatedData['longitude'],
                        'latitude' =>  $validatedData['latitude'],
                        'boite_postale' =>  $validatedData['boite_postale'],
                        'pays' =>  $validatedData['pays'],
                        'ville' =>  $validatedData['ville'],
                        'rue' =>  $validatedData['rue'],
                        'description' =>  $validatedData['description'],
                    ]);
                    $etablissement->localisation_id = $localisation->id;
                } else {

                    $localisation = $etablissement->localisation;
                    $localisation->update([
                        'longitude' =>
                        $validatedData['longitude'],
                        'latitude' =>  $validatedData['latitude'],
                        'boite_postale' =>  $validatedData['boite_postale'],
                        'pays' =>  $validatedData['pays'],
                        'ville' =>  $validatedData['ville'],
                        'rue' =>  $validatedData['rue'],
                        'description' =>  $validatedData['description'],
                    ]);
                }
            }

            $etablissement->save();
            $localisation->save();


            return
                $etablissement;
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }
    }


    /**
     * Show the form for creating a new resource .
     *
     * @return        \Illuminate\Http\JsonResponse

     */
    public function storeSpeciality(Request $request)
    {
        try {



            $validatedData = $request->validate([
                'etablissement_id' => 'required|integer',
                'specialite' => 'required|array',


            ]);

            $etablissement = Etablissement::where('id', $validatedData['etablissement_id'])
                ->get();

            if (
                count($etablissement) == 0 ||
                count($validatedData['specialite']) == 0
            ) {
                return response()->json(['status' => false]);
            } else {
                foreach ($validatedData['specialite'] as $specialite) {
                    $specialiteExist = Specialite::where('id', $specialite)
                        ->get();
                    if (
                        count($specialiteExist) != 0
                    ) {


                        $SpecialiteEtablissement = SpecialiteEtablissement::where('etablissement_id', $validatedData['etablissement_id'])
                            ->where('specialite_id', $specialite)
                            ->get();

                        if (
                            count($SpecialiteEtablissement) == 0
                        ) {

                            $newLSE =   SpecialiteEtablissement::create([
                                'etablissement_id' =>
                                $validatedData['etablissement_id'],
                                'specialite_id' =>  $specialite,

                            ]);


                            $newLSE->save();
                        }
                    }
                }
            }


            // return  $this->getEtablissement($validatedData['etablissement_id'],);
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }
    }

    /**
     * Show the form for creating a new resource .
     *
     * @return        \Illuminate\Http\JsonResponse

     */
    public function deletteEtablissmentSpeciality(Request $request)
    {
        try {



            $validatedData = $request->validate([
                'etablissement_id' => 'required|integer',
                'specialite_id' => 'required|integer',


            ]);



            $SpecialiteEtablissement = SpecialiteEtablissement::where('etablissement_id', $validatedData['etablissement_id'])
                ->where('specialite_id', $validatedData['specialite_id'])
                ->first();



            $SpecialiteEtablissement->delete();


            // return  $this->getEtablissement($validatedData['etablissement_id'],);
        } catch (ValidationException $exception) {
            return response()->json([
                'errors' => $exception->errors(),
            ], 422);
        }
    }
}
