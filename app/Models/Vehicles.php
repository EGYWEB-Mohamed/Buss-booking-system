<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicles extends Model
{
    use HasFactory;
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
