<?php

namespace App\Observers;

use App\Trip;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TripObserver
{
    public function creating(Trip $trip): void
    {
        $trip->trip_reference = IdGenerator::generate(['table' => 'trips',
                                                       'field' => 'trip_reference',
                                                       'length' => 15,
                                                       'prefix' => 'T-'.date('ymd'),
        ]);
    }

    public function updated(Trip $trip): void
    {
    }

    public function deleted(Trip $trip): void
    {
    }

    public function restored(Trip $trip): void
    {
    }

    public function forceDeleted(Trip $trip): void
    {
    }
}
