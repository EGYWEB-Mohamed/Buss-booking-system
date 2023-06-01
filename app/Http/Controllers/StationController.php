<?php

namespace App\Http\Controllers;

use App\Http\Resources\StationResource;
use App\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index()
    {
        return StationResource::collection(Station::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        return new StationResource(Station::create($request->validated()));
    }

    public function show(Station $station)
    {
        return new StationResource($station);
    }

    public function update(Request $request, Station $station)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $station->update($request->validated());

        return new StationResource($station);
    }

    public function destroy(Station $station)
    {
        $station->delete();

        return response()->json();
    }
}
