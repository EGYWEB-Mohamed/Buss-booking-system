<?php

namespace App\Http\Controllers;

use App\Station;
use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function index()
    {
        $fromStation = Station::find(1);
        $toStation = Station::find(5);
        $trips = Trip::with(['itineraries','vehicle'])->whereHas('reservations',function (Builder $builder) {
                            $builder->select('trip_id')
                                    ->groupBy('trip_id')
                                    ->havingRaw('COUNT(*) < MAX(trips.max_seats)');
                        })
                     ->orWhereDoesntHave('reservations')
                     ->get();

        dd($trips);
    }
}
