<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

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
