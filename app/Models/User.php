<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"name", "email", "password"},
 *     @OA\Property(property="id", type="integer", description="User ID"),
 *     @OA\Property(property="name", type="string", description="User's name"),
 *     @OA\Property(property="email", type="string", description="User's email address"),
 *     @OA\Property(property="password", type="string", description="User's password"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", description="Timestamp when email was verified"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Account creation date"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Last account update date")
 * )
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // Assure-toi d'utiliser HasApiTokens ici

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function plantes()
    {
        return $this->belongsToMany(Plantes::class, 'plante_user', 'user_id', 'plante_id');
    }
}
