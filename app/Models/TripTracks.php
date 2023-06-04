<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TripTracks extends Model
{
    protected $fillable = [
        'trip_id',
        'from_station_id',
        'to_station_id',
    ];

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function fromStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'from_station_id');
    }

    public function toStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'to_station_id');
    }
}
