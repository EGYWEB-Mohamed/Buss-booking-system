<div>
    <form wire:submit.prevent="search" class="my-3">
        <div class="row">
            <div class="form-group col-6">
                <label for="from">From</label>
                <div wire:ignore>
                    <select data-placeholder="Please Select Nearest Station From you" data-pharaonic="select2" data-component-id="{{ $this->id }}" wire:model.defer="fromStation">
                        <option value="" selected></option>
                        @foreach($stations as $station)
                            <option value="{{ $station->id }}">{{ $station->name }}</option>
                        @endforeach
                    </select>
                </div>
                    @error('fromStation') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-6">
                <label for="to">To</label>
                <div wire:ignore>
                    <select data-placeholder="Please Select Your Distinction" data-pharaonic="select2" data-component-id="{{ $this->id }}" wire:model.defer="toStation">
                        <option value="" selected></option>
                        @foreach($stations as $station)
                            <option value="{{ $station->id }}">{{ $station->name }}</option>
                        @endforeach
                    </select>
                </div>
                    @error('toStation') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-12">
                <button wire:loading.attr="disabled" class="mt-2 btn btn-success w-100" type="submit">Search</button>
            </div>
        </div>
    </form>
    @if($trips->isNotEmpty())
        <ol class="list-group list-group-numbered">
            @foreach($trips as $trip)
                <li class="list-group-item d-flex justify-content-between align-items-start my-1 border-2 @if($trip->is_fully_booked) border-danger @else border-success @endif">
                    <div class="ms-2 me-auto">
                        <small>#{{ $trip->trip_reference }}</small> |
                        <span class="text-bold">
                            <span class="text-primary">Leave Time : {{ $trip->start_date->format("m/d/Y H:i a") }}</span> <-> <span class="text-danger">Arrive Time : {{ $trip->end_date->format("m/d/Y H:i a") }}</span>
                        </span><br>
                        <div class="fw-bold">
                            Start Station (<span class="text-primary">{{ $trip->startingPoint->name }}</span>) -> Final
                            Station (<span class="text-primary">{{ $trip->endingPoint->name }}</span>) |
                            @if($trip->is_fully_booked)
                                <span class="text-danger">Sorry This Trip is Fully Booked</span>
                            @else
                                <span class="text-success">Available Seats ( {{ $trip->AvailableSeats() }} )</span>
                            @endif
                        </div>
                        <b>Trip Itineraries</b> <br>
                        <code>{{ implode(' -> ',$trip->itineraries->pluck('station.name')->toArray()) }}</code>
                    </div>
                    <div class="text-center">
                        <span class="badge bg-success rounded-pill">{{ $trip->cost }} EGP</span> <hr>
                        @if($trip->is_fully_booked)
                            <button disabled class="btn btn-danger">Fully Booked</button>
                        @else
                            <button wire:click="reserveTrip({{ $trip->id }})" class="btn btn-outline-success">Reserve Now</button>
                        @endif
                    </div>

                </li>
            @endforeach
        </ol>
    @else
        <div class="alert alert-warning text-center">
            <b>Sorry There are no Trips right now </b>
        </div>
    @endif
</div>
