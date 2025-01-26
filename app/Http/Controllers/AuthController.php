<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(Request $request)
    {
        $userLogin = $this->userService->register($request->all(), $request);
        return response()->json([
            "user" => $userLogin
        ], 201);
    }
    public function login(Request $request)
    {
        $userLogin = $this->userService->login($request);
        return response()->json([
            "user" => $userLogin
        ], 201);
    }
    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }
}
