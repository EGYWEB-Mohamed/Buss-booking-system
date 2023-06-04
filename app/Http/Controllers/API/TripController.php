<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'from_station' => 'required|exists:stations,id|different:to_station',
            'to_station'   => 'required|exists:stations,id|different:from_station',
        ]);
        $trips = Trip::search($request->get('from_station'),$request->get('to_station'))->get();
        return TripResource::collection($trips);
    }
}
