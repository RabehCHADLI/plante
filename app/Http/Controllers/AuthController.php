<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="PlanteLand API", description="Arrosage pas automatique", version="1.0.0")
 * @OA\Server(url="http://localhost:8000")
 */
class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     description="Register a new user and return the user data.",
     *     operationId="registerUser",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function register(Request $request)
    {
        $userLogin = $this->userService->register($request->all(), $request);
        session(['auth_token' => $userLogin->original->token]);
        return response()->json([
            "user" => $userLogin
        ], 201);
    }
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login an existing user",
     *     description="Login an existing user and return the user data.",
     *     operationId="loginUser",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User logged in successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object", ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid credentials"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $userLogin = $this->userService->login($request);
        return response()->json([
            "user" => $userLogin
        ], 201);
    }
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout the user",
     *     description="Logout the current user.",
     *     operationId="logoutUser",
     *     tags={"Authentication"},
     *     @OA\Response(
     *         response=200,
     *         description="User logged out successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Logout failed"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }
}
