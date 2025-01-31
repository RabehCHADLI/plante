<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlanteApiDataService;
use Illuminate\Support\Facades\Http;

class PlanteApiDataController extends Controller
{
    protected $planteApiDataService;
    public function __construct(PlanteApiDataService $planteApiDataService)
    {
        $this->planteApiDataService = $planteApiDataService;
    }


    public function addAllPlante()
    {
        $this->planteApiDataService->addAllPlante();
    }
}
