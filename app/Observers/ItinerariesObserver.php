<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Observers;

use App\Models\Itinerary;
use App\Services\GenerateTripSequences;

class ItinerariesObserver
{
    public function created(Itinerary $itinerary): void
    {

        (new GenerateTripSequences())->generate($itinerary->trip);
    }

    public function updated(Itinerary $itinerary): void
    {
        (new GenerateTripSequences())->generate($itinerary->trip);
    }

    public function deleted(Itinerary $itinerary): void
    {
        (new GenerateTripSequences())->generate($itinerary->trip);
    }

    public function restored(Itinerary $itinerary): void
    {
    }

    public function forceDeleted(Itinerary $itinerary): void
    {
    }
}
