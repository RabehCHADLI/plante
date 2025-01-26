<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanteUser extends Model
{
    // Spécifie le nom de la table si elle ne suit pas la convention par défaut
    protected $table = 'plante_user';

    // Définir les attributs qui peuvent être massivement assignés
    protected $fillable = [
        'user_id',
        'plante_id',
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle Plante
    public function plante()
    {
        return $this->belongsTo(Plantes::class);
    }
}
