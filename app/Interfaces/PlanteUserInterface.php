<?php

namespace App\Interfaces;

interface PlanteUserInterface
{
    public function attachUserToPlante($userId, $planteId);

    public function detachUserFromPlante($userId, $planteId);

    public function getUsersByPlante($planteId);

    public function getPlantesByUser($userId);
}
