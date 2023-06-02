<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        parent::creating(function ($reservation){
            $reservation->order_reference = IdGenerator::generate(['table' => 'reservations',
                                                                   'field' => 'order_reference',
                                                                   'length' => 15,
                                                                   'prefix' => 'O-'.date('ymd'),
            ]);
        });
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
