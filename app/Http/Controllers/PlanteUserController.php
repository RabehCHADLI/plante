<?php

namespace App\Http\Controllers;

use App\Services\PlanteUserService;
use Illuminate\Http\Request;

class PlanteUserController extends Controller
{
    protected $planteUserService;

    public function __construct(PlanteUserService $planteUserService)
    {
        $this->planteUserService = $planteUserService;
    }

    public function attachUserToPlante(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plante_id' => 'required|exists:plantes,id',
        ]);

        $result = $this->planteUserService->attachUserToPlante($request->plante_id, $request->user_id);

        return response()->json([
            'message' => 'Utilisateur attaché à la plante avec succès',
            'data' => $result,
        ], 200);
    }

    public function detachUserFromPlante(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plante_id' => 'required|exists:plantes,id',
        ]);

        $result = $this->planteUserService->detachUserFromPlante($request);

        return response()->json([
            'message' => 'Utilisateur détaché de la plante avec succès',
            'data' => $result,
        ], 200);
    }
    public function getPlantesByUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        return $result = $this->planteUserService->getPlantesByUser($request);
    }
}
