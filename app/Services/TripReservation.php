<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Station;
use App\Models\Trip;
use Exception;
use Illuminate\Support\Facades\DB;

class TripReservation
{
    public function create(Trip $trip,int $fromStation,int $toStation): array
    {

        if ($trip->is_fully_booked){
            return [
                'success' => false,
                'message' => 'Sorry, But This Trip is Fully Booked Now'
            ];
        }
        DB::beginTransaction();
        try {
            $fromStation = Station::find($fromStation);
            $toStation = Station::find($toStation);
            $reservation = Reservation::create([
                'user_id' => auth()->id(),
                'trip_id' => $trip->id,
                'from_station' => $fromStation->id,
                'to_station' => $toStation->id,
                'confirmed' => true
            ]);
            DB::commit();
            return [
                'success' => true,
                'message' => 'Reservation Succeed Order ID : #'.$reservation->order_refrance
            ];
        } catch (Exception $exception) {
            DB::rollback();
            return [
                'success' => false,
                'message' => $exception->getMessage()
            ];
        }
    }
}
