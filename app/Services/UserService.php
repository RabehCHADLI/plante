<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserService
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    public function register(array $dataRegister, Request $request): JsonResponse
    {

        $this->userInterface->register($dataRegister);
        $response = $this->login($request);
        return $response;
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            if ($user instanceof \App\Models\User) {
                $token = $user->createToken('B-token')->plainTextToken;
            } else {
                return response()->json([
                    'token' => "pas d'instance de user bug bug bug",
                ]);
            }
            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
    public function generateToken(User $user)
    {
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }
}
