<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeding extends Model
{
    protected $fillable = [
        'feeding_time',
        'amount_ml',
        'feeding_type',
        'duration_minutes',
        'notes',
    ];

    protected $casts = [
        'feeding_time' => 'datetime',
        'amount_ml' => 'decimal:2',
    ];
}
