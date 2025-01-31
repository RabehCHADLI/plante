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

    /**
     * @OA\Get(
     *     path="/api/plantes",
     *     summary="Récupérer toutes les plantes",
     *     @OA\Response(
     *         response=200,
     *         description="Liste de plantes",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Plantes"))
     *     )
     * )
     */

    public function index(): JsonResponse
    {
        $plantes = $this->planteService->getAllPlantes();
        return response()->json($plantes);
    }

    /**
     * @OA\Get(
     *     path="/api/plantes/{id}",
     *     tags={"Plante"},
     *     summary="Get a specific plante by ID",
     *     description="Returns a single plante by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the plante",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The requested plante",
     *         @OA\JsonContent(
     *             type="object",
     *             properties={
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="common_name", type="string", example="Rose"),
     *                 @OA\Property(property="city", type="string", example="Paris"),
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Plante not found"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        return $this->planteService->getPlanteById($id);
    }

    /**
     * @OA\Post(
     *     path="/api/plantes",
     *     tags={"Plante"},
     *     summary="Create a new plante",
     *     description="Creates a new plante with the given data",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"common_name", "watering_general_benchmark", "watering_general_benchmark.value", "watering_general_benchmark.unit"},
     *             @OA\Property(property="common_name", type="string", example="Rose"),
     *             @OA\Property(property="watering_general_benchmark", type="array", 
     *                 @OA\Items(
     *                     type="object",
     *                     properties={
     *                         @OA\Property(property="value", type="number", example=1.5),
     *                         @OA\Property(property="unit", type="string", example="liters")
     *                     }
     *                 )
     *             ),
     *             @OA\Property(property="city", type="string", example="Paris"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Plante created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             properties={
     *                 @OA\Property(property="message", type="string", example="Plante créée avec succès"),
     *                 @OA\Property(property="plante", type="object")
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input data"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/plantes/{id}",
     *     tags={"Plante"},
     *     summary="Delete a plante by ID",
     *     description="Deletes a plante with the given ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the plante to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Plante deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             properties={
     *                 @OA\Property(property="message", type="string", example="Plante supprimée avec succès")
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Plante not found"
     *     )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $this->planteService->delPlante($id);
        return response()->json(['message' => 'Plante supprimée avec succès']);
    }
}
