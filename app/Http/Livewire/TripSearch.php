<?php

namespace App\Http\Livewire;

use App\Models\Station;
use App\Models\Trip;
use App\Services\TripReservation;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TripSearch extends Component
{
    public Collection $stations;

    public $fromStation;

    public $toStation;

    public $trips;

    public $requiredTrip;

    protected $rules = [
        'fromStation' => 'required|exists:stations,id|different:toStation',
        'toStation' => 'required|exists:stations,id|different:fromStation',
    ];

    protected $listeners = [
        'paymentConfirmed',
        'paymentCancelled',
    ];

    use LivewireAlert;

    public function mount()
    {
        $this->stations = Station::all();
        $this->trips = new Collection();
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.trip-search');
    }

    public function search()
    {
        $this->validate();
        $fromStation = $this->fromStation;
        $toStation = $this->toStation;

        // Old  One
        //        $trips = Trip::with(['itineraries'])
        //                     ->whereHas('reservations',function (Builder $builder) {
        //                         $builder->select('trip_id')
        //                                 ->groupBy('trip_id')
        //                                 ->havingRaw('COUNT(*) < MAX(trips.max_seats)');
        //                     })
        ////                     ->orWhereDoesntHave('reservations')
        //                     ->where('start_date','>',$date)
        //                     ->where(['starting_station_id' => $fromStation,'ending_station_id' => $toStation])
        //                     ->orWhere(function (Builder $builder) use ($fromStation,$toStation) {
        //                        $builder
        //                            ->where(function (Builder $builder) use ($fromStation) {
        //                                $builder->where('starting_station_id',$fromStation)->orWhereHas('itineraries',function (Builder $builder) use ($fromStation){
        //                                    $builder->where('station_id',$fromStation);
        //                                });
        //                            })
        //                                // And
        //                            ->where(function (Builder $builder) use ($toStation) {
        //                                $builder->where('ending_station_id',$toStation)->orWhereHas('itineraries',function (Builder $builder) use ($toStation){
        //                                    $builder->where('station_id',$toStation);
        //                                });
        //                            });
        //                     })
        //                     ->get();

        $trips = Trip::search($fromStation,$toStation)->get();
        $this->trips = $trips;
    }

    public function reserveTrip(Trip $trip)
    {
        $this->confirm('question', [
            'title' => 'Are You Sure?',
            'text' => 'If Click on confirm you will redirect to process the payment and pay ' . $trip->cost . ' EGP',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Confirm Payment',
            'allowOutsideClick' => true,
            'showCancelButton' => true,
            'cancelButtonText' => 'Cancel',
            'onConfirmed' => 'paymentConfirmed',
            'onDismissed' => 'paymentCancelled',
            'timer' => false,
        ]);
        $this->requiredTrip = $trip;
    }

    public function paymentConfirmed(TripReservation $tripReservation)
    {
        $check = $tripReservation->create($this->requiredTrip, intval($this->fromStation), intval($this->toStation));

        $this->alert(($check['success']) ? 'success' : 'error', $check['message']);
        $this->search();
    }

    public function paymentCancelled()
    {
        $this->requiredTrip = null;
    }
}
