<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItineraryResource;
use App\Models\Itinerary;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index()
    {
        return ItineraryResource::collection(Itinerary::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'trip_id' => ['required', 'integer'],
            'station_id' => ['required', 'integer'],
        ]);

        return new ItineraryResource(Itinerary::create($request->validated()));
    }

    public function show(Itinerary $itinerary)
    {
        return new ItineraryResource($itinerary);
    }

    public function update(Request $request, Itinerary $itinerary)
    {
        $request->validate([
            'trip_id' => ['required', 'integer'],
            'station_id' => ['required', 'integer'],
        ]);

        $itinerary->update($request->validated());

        return new ItineraryResource($itinerary);
    }

    public function destroy(Itinerary $itinerary)
    {
        $itinerary->delete();

        return response()->json();
    }
}
