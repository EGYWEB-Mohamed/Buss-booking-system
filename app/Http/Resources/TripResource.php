<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Trip */
class TripResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'trip_reference' => $this->trip_reference,
            'cost' => $this->cost,
            'starting_station' => StationResource::make($this->startingPoint),
            'ending_station' => StationResource::make($this->endingPoint),
            'vehicle' => vehiclesResource::make($this->vehicle),
            'available_seats' => $this->AvailableSeats(),
            'is_fully_booked' => $this->is_fully_booked,
            'created_at' => DateTimeResource::make($this->created_at),
            'updated_at' => DateTimeResource::make($this->updated_at),
        ];
    }
}
