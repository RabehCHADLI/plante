<?php

namespace App\Repositories;

use App\Interfaces\PlanteInterface;
use App\Interfaces\UserInterface;
use App\Models\Plantes;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class PlanteRepository implements PlanteInterface
{
    public function getAllPlantes(): array
    {
        $plantes = Plantes::all()->toArray();
        return $plantes;
    }
    public function getPlanteById($id): array
    {
        $plante = Plantes::find($id)->first();
        return $plante->load('users');
    }
    public function createPlante(array $data): array
    {
        $plante = Plantes::create($data);
        return [$plante];
    }
    public function delPlante($id): array
    {
        $plante = Plantes::find($id)->first();
        if ($plante) {
            $plante->delete();
            return ['message' => 'Plante Bien Supprimé'];
        }
    }
}
