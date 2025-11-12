<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiaperChange extends Model
{
    protected $fillable = [
        'change_time',
        'is_wet',
        'is_dirty',
        'notes',
    ];

    protected $casts = [
        'change_time' => 'datetime',
        'is_wet' => 'boolean',
        'is_dirty' => 'boolean',
    ];
}
