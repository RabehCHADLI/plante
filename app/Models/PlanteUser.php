<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

class PlanteUser extends Model
{
    /**
     * @OA\Schema(
     *     schema="PlanteUser",
     *     type="object",
     *     required={"user_id", "plante_id"},
     *     @OA\Property(property="user_id", type="integer", example=1),
     *     @OA\Property(property="plante_id", type="integer", example=1)
     * )
     */
    protected $table = 'plante_user';

    protected $fillable = [
        'user_id',
        'plante_id',
    ];

    /**
     * Relation avec l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la plante.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plante()
    {
        return $this->belongsTo(Plantes::class);
    }
}
