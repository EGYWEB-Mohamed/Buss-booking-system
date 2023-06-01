<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        return TripResource::collection(Trip::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'starting_station_id' => ['required', 'integer'],
            'ending_station_id' => ['required', 'integer'],
        ]);

        return new TripResource(Trip::create($request->validated()));
    }

    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    public function update(Request $request, Trip $trip)
    {
        $request->validate([
            'starting_station_id' => ['required', 'integer'],
            'ending_station_id' => ['required', 'integer'],
        ]);

        $trip->update($request->validated());

        return new TripResource($trip);
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();

        return response()->json();
    }
}
