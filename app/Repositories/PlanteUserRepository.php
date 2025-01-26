<?php

namespace App\Repositories;

use App\Interfaces\PlanteUserInterface;
use App\Models\PlanteUser;

class PlanteUserRepository implements PlanteUserInterface
{
    public function attachUserToPlante($userId, $planteId)
    {
        $exists = PlanteUser::where('user_id', $userId)
            ->where('plante_id', $planteId)
            ->exists();

        if ($exists) {
            return [
                'status' => 'error',
                'message' => 'L\'utilisateur est déjà lié à cette plante'
            ]; // Ceci retourne un array
        }

        $liaison = PlanteUser::create([
            'user_id' => $userId,
            'plante_id' => $planteId,
        ]);

        return [
            'status' => 'success',
            'message' => 'Utilisateur lié à la plante avec succès',
            'liaison' => $liaison
        ];
    }


    public function detachUserFromPlante($userId, $planteId)
    {

        $plante =  PlanteUser::where('user_id', $userId)
            ->where('plante_id', $planteId)
            ->delete();
        return [$plante];
    }

    public function getUsersByPlante($planteId)
    {
        return PlanteUser::where('plante_id', $planteId)
            ->with('user')
            ->get();
    }

    public function getPlantesByUser($userId)
    {
        return PlanteUser::where('user_id', $userId)
            ->with('plante')
            ->get();
    }
}
