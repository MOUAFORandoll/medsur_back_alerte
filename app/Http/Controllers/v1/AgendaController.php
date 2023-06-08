<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AgendaController extends Controller
{

    public function index(Request $request){

        /* if($request->search != ""){
            $agendas = Agenda::like('valeur', $request->search)->get(['id', 'valeur', 'description']);
        }else{
           
        } */
        $size = $request->size ?? 25;
        $agendas = Agenda::with('etablissements')->paginate($size);;

        return $this->successResponse($agendas);

    }

    public function show($agenda){

        $agenda = Agenda::findOrFail($agenda)->makeHidden(['created_at', 'updated_at', 'deleted_at']);
        return $this->successResponse($agenda);

    }

    public function store(Request $request){

        $this->validate($request, $this->validation());
        $agenda = Agenda::create([
            'libelle' => $request->libelle
        ]);

        return $this->successResponse($agenda);

    }

    public function update(Request $request, $agenda){
        $this->validate($request, $this->validation());
        $agenda = Agenda::findOrFail($agenda);
        $agenda = $agenda->fill([
            'libelle' => $request->libelle
        ]);

        if ($agenda->isClean()) {
            return $this->errorResponse("aucune valeur n'a été mise à jour", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $agenda->save();
        return $this->successResponse($agenda);

    }

    public function destroy($agendas){
        $agendas = Agenda::findOrFail($agendas);
        $agendas->delete();
        return $this->successResponse($agendas);
    }

    /**
     * fonction de validation des formulaires
     */
    public function validation($is_update = null){
        $rules = [
            'libelle' => 'required'
        ];
        return $rules;
    }
}


