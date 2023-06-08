<?php

namespace App\Http\Controllers\v1;

use App\Services\NotationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotationController extends Controller
{

    private $notationService;


    public function __construct(NotationService $notationService)
    {
        $this->notationService = $notationService;
    }


    public function index(Request $request)
    {

        $notations = $this->notationService->index($request);

        return $this->successResponse($notations);

    }

    /**
     * Show the form for creating a new resource or update if existing .
     *
     * @return        \Illuminate\Http\JsonResponse

     */
    public function store(Request $request)
    {
        $notations = $this->notationService->store($request);

        return $this->successResponse($notations);
    }
    /**
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getNote(Request $request)
    {
        $validatedData = $request->validate(['etablissement_id' => 'required|integer']);

        $note = $this->notationService->getNote($validatedData['etablissement_id']);

        return $this->successResponse($note);
    }
}
