<?php

namespace App\Services;

use App\Interfaces\PlanteInterface;
use App\Interfaces\PlanteUserInterface;
use Illuminate\Http\Request;

class PlanteUserService
{

    protected $planteUserInterface;
    public function __construct(PlanteUserInterface $planteUserInterface)
    {
        $this->planteUserInterface = $planteUserInterface;
    }
    public function attachUserToPlante($planteId, $userId): array
    {
        return $this->planteUserInterface->attachUserToPlante($userId, $planteId);
    }
    public function detachUserFromPlante(Request $request): array
    {
        return $this->planteUserInterface->detachUserFromPlante($request->user_id, $request->plante_id);
    }
    public function getPlantesByUser(Request $request)
    {
        return $this->planteUserInterface->getPlantesByUser($request->user_id);
    }
}
