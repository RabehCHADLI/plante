<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Plantes",
 *     description="Model representing a plante",
 *     @OA\Property(property="id", type="integer", description="Unique identifier for the plante", example=1),
 *     @OA\Property(property="common_name", type="string", description="The common name of the plante", example="Rose"),
 *     @OA\Property(property="watering_general_benchmark", type="array", 
 *         @OA\Items(
 *             type="object",
 *             @OA\Property(property="value", type="number", example=1.5),
 *             @OA\Property(property="unit", type="string", example="liters")
 *         )
 *     ),
 *     @OA\Property(property="city", type="string", description="The city where the plante is located", example="Paris"),
 * )
 */
class Plantes extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_name',
        'watering_general_benchmark',
        'city',
    ];

    protected $casts = [
        'watering_general_benchmark' => 'array',
    ];

    /**
     * @OA\Property(
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/User")
     * )
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'plante_user', 'plante_id', 'user_id');
    }
}
