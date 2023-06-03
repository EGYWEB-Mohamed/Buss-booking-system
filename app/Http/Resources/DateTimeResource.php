<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DateTimeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'date_time' => $this->diffForHumans(),
            'readable_date_time' => $this->toDateTimeString(),
        ];
    }
}
