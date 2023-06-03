<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicles extends Model
{
    protected $fillable = [
        'driver_name',
        'plate_number',
        'max_seats',
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}
