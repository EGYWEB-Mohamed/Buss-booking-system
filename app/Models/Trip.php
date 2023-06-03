<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    protected $withCount = [
        'reservations',
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
        return $this->hasMany(Reservation::class)
                    ->withoutGlobalScopes();
    }

    public function TripTracks(): HasMany
    {
        return $this->hasMany(TripTracks::class);
    }

    public function AvailableSeats(): int
    {
        return $this->vehicle->max_seats - $this->reservations_count;
    }

    public function scopeSearch($query,int $fromStation,int $toStation)
    {
        $query->with(['vehicle'])
              ->withCount('reservations')
              ->whereHas('vehicle',function (Builder $builder) {
                  $builder->where('max_seats','>','trips.reservations_count');
              })
              ->where('start_date','>',Carbon::today())
              ->whereHas('TripTracks',function (Builder $builder) use ($fromStation,$toStation) {
                  $builder->where([
                      'from_station_id' => $fromStation,
                      'to_station_id'   => $toStation,
                  ]);
              });
    }

    protected function isFullyBooked(): Attribute
    {
        return Attribute::get(function () {
            return $this->reservations_count >= $this->vehicle->max_seats;
        });
    }
}
