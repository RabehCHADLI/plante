<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface UserInterface
{
    public function register(array $data): JsonResponse;
}
