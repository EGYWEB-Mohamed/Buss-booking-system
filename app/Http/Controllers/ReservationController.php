<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return ReservationResource::collection(Reservation::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => ['required'],
            'user_id' => ['required'],
            'confirmed' => ['required'],
        ]);

        return new ReservationResource(Reservation::create($request->validated()));
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'trip_id' => ['required'],
            'user_id' => ['required'],
            'confirmed' => ['required'],
        ]);

        $reservation->update($request->validated());

        return new ReservationResource($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json();
    }
}
