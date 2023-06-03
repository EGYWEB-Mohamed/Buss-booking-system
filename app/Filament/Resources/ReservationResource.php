<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $slug = 'reservations';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('trip_id')
                  ->columns(2)
                  ->relationship('trip', 'trip_reference')
                  ->required(),

            Select::make('user_id')
                  ->columns(2)
                  ->relationship('user', 'name')
                  ->required(),

            Toggle::make('confirmed'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('trip.trip_reference'),
            TextColumn::make('user.name')->hidden(function (){
                return auth()->user()->hasRole('client');
            }),
            TextColumn::make('trip.vehicle.driver_name')->label('Drive Name & Vehicle Plate Number')->description(fn (Reservation $record): string => $record->trip->vehicle->plate_number),
            TextColumn::make('fromStation.name')
                      ->description(fn(Reservation $record): string => 'Bus Itinerary : '.$record->trip->startingPoint->name)
                      ->label('From Station'),
            TextColumn::make('toStation.name')
                      ->description(fn(Reservation $record): string => 'Bus Itinerary : '.$record->trip->endingPoint->name)
                      ->label('To Station'),

            IconColumn::make('confirmed')->boolean(),
        ])->actions([
            ViewAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
