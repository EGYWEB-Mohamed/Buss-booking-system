<?php

namespace App;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = [
        'starting_station_id',
        'ending_station_id',
        'cost',
        'vehicle_id',
        'max_seats',
        'start_date',
        'end_date',
    ];

    public function startingPoint(): BelongsTo
    {
        return $this->belongsTo(Station::class,'starting_station_id');
    }

    public function endingPoint(): BelongsTo
    {
        return $this->belongsTo(Station::class,'ending_station_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class);
    }

    public function itineraries(): HasMany
    {
        return $this->hasMany(Itinerary::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
