<?php

namespace App\Services;

use App\Interfaces\PlanteInterface;
use Illuminate\Http\Request;

class PlanteService
{
    protected $planteInterface;

    public function __construct(PlanteInterface $planteInterface)
    {
        $this->planteInterface = $planteInterface;
    }
    public function getAllPlantes()
    {
        return $this->planteInterface->getAllPlantes();
    }
    public function getPlanteById($id)
    {
        return response()->json([
            "plante" => $this->planteInterface->getPlanteById($id)
        ]);
    }
    public function createPlante(Request $request)
    {
        return $this->planteInterface->createPlante($request->all());
    }
    public function delPlante(int $id)
    {
        return $this->planteInterface->delPlante($id);
    }
}
