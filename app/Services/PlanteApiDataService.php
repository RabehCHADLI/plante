<?php

namespace App\Services;

use App\Interfaces\PlanteApiDataInterface;
use Illuminate\Support\Facades\Http;

class PlanteApiDataService
{
    protected $planteApiDataInterface;
    public function __construct(PlanteApiDataInterface $planteApiDataInterface)
    {
        $this->planteApiDataInterface = $planteApiDataInterface;
    }
    public function addAllPlante()
    {
        $response = Http::get("https://perenual.com/api/species-list?key=sk-O1aE679a49c64eb548429&page=1");

        foreach ($response->json()['data'] as $plante) {
            $this->planteApiDataInterface->addAllPlante($plante);
        }
    }
}
