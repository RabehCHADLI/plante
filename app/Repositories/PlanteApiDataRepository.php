<?php

namespace App\Repositories;

use App\Interfaces\PlanteApiDataInterface;
use App\Models\PlanteApiData;

class PlanteApiDataRepository implements PlanteApiDataInterface
{
    public function addAllPlante($planteApi)
    {
        $plante = PlanteApiData::create($planteApi);
    }
}
