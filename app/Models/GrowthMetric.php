<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrowthMetric extends Model
{
    protected $fillable = [
        'measurement_time',
        'weight_kg',
        'height_cm',
        'head_circumference_cm',
        'notes',
    ];

    protected $casts = [
        'measurement_time' => 'datetime',
        'weight_kg' => 'decimal:2',
        'height_cm' => 'decimal:2',
        'head_circumference_cm' => 'decimal:2',
    ];
}
