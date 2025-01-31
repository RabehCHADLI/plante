<?php

namespace App\Interfaces;

use App\Models\PlanteApiData;
use Illuminate\Http\JsonResponse;

interface PlanteApiDataInterface
{
    public function addAllPlante($planteApi);
}
