<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\Trip;
use App\Traits\ApiResponses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    use ApiResponses;
    public function index()
    {
        $reservations = Reservation::paginate();
        return ReservationResource::collection($reservations);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'trip_id' => ['required','exists:trips,id'],
            'from_station' => ['required'],
            'to_station' => ['required'],
        ]);
        $trip = Trip::whereHas('TripTracks',function (Builder $builder) use ($request){
            $builder->where([
                'from_station_id' => $request->get('from_station'),
                'to_station_id' => $request->get('to_station'),
            ]);
        })->find($request->get('trip_id'));
        if (!$trip){
            return $this->sendError('This trip does not match the client From or To Station');
        }
        $data['user_id'] = auth()->id();
        $data['confirmed'] = true;
        $reservation = Reservation::create($data);
        return ReservationResource::make($reservation);
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }
}
