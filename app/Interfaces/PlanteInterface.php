<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface PlanteInterface
{
    public function getAllPlantes(): array;
    public function getPlanteById(int $id): array;
    public function createPlante(array $data): array;
    public function delPlante($id): array;
}
