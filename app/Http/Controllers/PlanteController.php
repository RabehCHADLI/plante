<?php

namespace App\Http\Controllers;

use App\Services\PlanteService;
use App\Services\PlanteUserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PlanteController extends Controller
{
    protected $planteService;
    protected $planteUserService;

    public function __construct(PlanteService $planteService, PlanteUserService $planteUserService)
    {
        $this->planteService = $planteService;
        $this->planteUserService = $planteUserService;
    }

    public function index(): JsonResponse
    {
        $plantes = $this->planteService->getAllPlantes();
        return response()->json($plantes);
    }


    public function show(int $id): JsonResponse
    {
        return $this->planteService->getPlanteById($id);
    }


    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'common_name' => 'required|string|max:255',
            'watering_general_benchmark' => 'required|array',
            'watering_general_benchmark.value' => 'required|numeric',
            'watering_general_benchmark.unit' => 'required|string|max:50',
            'city' => 'nullable|string|max:100',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $plante = $this->planteService->createPlante($request);

        if ($request->has('user_id')) {
            $this->planteUserService->attachUserToPlante($plante[0]->id, $request->user_id);
            return response()->json(['message' => 'Plante créée avec succès', 'plante' => $plante], 201);
        }

        return response()->json(['message' => 'Plante créée avec succès', 'plante' => $plante], 201);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->planteService->delPlante($id);
        return response()->json(['message' => 'Plante supprimée avec succès']);
    }
}
