<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Etablissement;
use App\Services\EtablissementService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|string',
            'phone2' => 'required|string',
            'email' => 'required|string',
            'description' => 'required|string',

        ]);

        $etablissement = Etablissement::create([
            'name' => $request['name'],
            'name2' => $request-> name2 ?? '',
            'code' => Str::random(10) /*  $request['code'] */,
            'phone' =>  $request['phone'],
            'phone2' =>  $request['phone2'],
            'email' =>  $request['email'],
            'description' =>  $request['description'],
        ]);


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
    public function show($etablissement)
    {
        $etablissement = Etablissement::find($etablissement)->load(['localisation','specialites', 'Notation']);

        return $this->successResponse($etablissement);
    }
}
