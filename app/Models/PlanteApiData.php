<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanteApiData extends Model
{
    protected $table = 'plante_api_data';

    protected $fillable = [
        'common_name',
        'scientific_name',
        'other_name',
        'cycle',
        'watering',
        'sunlight',
        'default_image',
    ];

    protected $casts = [
        'scientific_name' => 'array',
        'other_name' => 'array',
        'sunlight' => 'array',
        'default_image' => 'array',
    ];
}
