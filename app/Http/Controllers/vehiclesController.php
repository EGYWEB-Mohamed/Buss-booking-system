<?php

namespace App\Http\Controllers;

use App\Http\Resources\vehiclesResource;
use App\vehicles;
use Illuminate\Http\Request;

class vehiclesController extends Controller
{
    public function index()
    {
        return vehiclesResource::collection(vehicles::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => ['required'],
        ]);

        return new vehiclesResource(vehicles::create($request->validated()));
    }

    public function show(vehicles $vehicles)
    {
        return new vehiclesResource($vehicles);
    }

    public function update(Request $request, vehicles $vehicles)
    {
        $request->validate([
            'plate_number' => ['required'],
        ]);

        $vehicles->update($request->validated());

        return new vehiclesResource($vehicles);
    }

    public function destroy(vehicles $vehicles)
    {
        $vehicles->delete();

        return response()->json();
    }
}
