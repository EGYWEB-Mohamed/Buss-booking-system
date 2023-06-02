<?php

namespace App\Services;

use App\Models\Trip;

class GenerateTripSequences
{
    public function generate(Trip $trip): bool
    {
        $tripStations = $trip->itineraries()
            ->orderBy('sort', 'asc')
            ->pluck('station_id')
            ->toArray();
        array_unshift($tripStations, $trip->starting_station_id);
        $tripStations[] = $trip->ending_station_id;
        $tripStations = $this->getCombinationsBetween($tripStations);
        $trip->TripTracks()->delete();
        foreach ($tripStations as $station) {
            $trip->TripTracks()
                ->create($station);
        }

        return true;
    }

    private function getCombinationsBetween($array): array
    {
        $combinations = [];
        $length = count($array);
        for ($i = 0; $i < $length; $i++) {
            for ($j = $i + 1; $j < $length; $j++) {
                $combinations[] = [
                    'from_station_id' => $array[$i],
                    'to_station_id' => $array[$j],
                ];
            }
        }

        return $combinations;
    }
}
