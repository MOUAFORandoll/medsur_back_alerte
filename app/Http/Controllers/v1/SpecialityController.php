<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;

use App\Models\Etablissement;
use App\Models\Specialite;
use App\Models\SpecialiteEtablissement;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    
    public function index(Request $request)
    {
        $specialites = Specialite::get(['id','libelle', 'libelle_en']);

        return $this->successResponse($specialites);
    }


}
