<?php

namespace App\Http\Controllers;

use App\Services\PlanteUserService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PlanteUserController extends Controller
{
    protected $planteUserService;

    public function __construct(PlanteUserService $planteUserService)
    {
        $this->planteUserService = $planteUserService;
    }

    /**
     * @OA\Post(
     *     path="/api/plante/attach",
     *     summary="Attacher un utilisateur à une plante",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "plante_id"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="plante_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur attaché à la plante avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Utilisateur attaché à la plante avec succès"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Mauvaise demande",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Les identifiants sont invalides")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/plante/detach",
     *     summary="Détacher un utilisateur d'une plante",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "plante_id"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="plante_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Utilisateur détaché de la plante avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Utilisateur détaché de la plante avec succès"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Mauvaise demande",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Les identifiants sont invalides")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/plante/plantes",
     *     summary="Récupérer les plantes par utilisateur",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des plantes de l'utilisateur",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Liste des plantes de l'utilisateur"),
     *             @OA\Property(property="data", type="array", @OA\Items(type="object"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Utilisateur non trouvé",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Utilisateur non trouvé")
     *         )
     *     )
     * )
     */
    public function getPlantesByUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        return $result = $this->planteUserService->getPlantesByUser($request);
    }
}
