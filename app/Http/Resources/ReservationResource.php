<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Reservation */
class ReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_reference' => $this->order_reference,
            'trip' => TripResource::make($this->trip),
            'user' => UserResource::make($this->user),
            'from_station' => StationResource::make($this->fromStation),
            'to_station' => StationResource::make($this->toStation),
            'confirmed' => (boolean) $this->confirmed,
            'created_at' => DateTimeResource::make($this->created_at),
            'updated_at' => DateTimeResource::make($this->updated_at),
        ];
    }
}
