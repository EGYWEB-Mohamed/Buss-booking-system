<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Filament\Resources\TripResource\RelationManagers\ItinerariesRelationManager;
use App\Models\Trip;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $slug = 'trips';

    protected static ?string $recordTitleAttribute = 'trip_reference';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    TextInput::make('cost')
                        ->required(),
                    Grid::make(4)
                        ->schema([
                            Select::make('starting_station_id')
                                ->required()
                                ->label('Start Point ( Station )')
                                ->relationship('startingPoint', 'name'),
                            Select::make('ending_station_id')
                                ->label('End Point ( Station )')
                                ->required()
                                ->relationship('endingPoint', 'name'),
                            TextInput::make('max_seats')
                                ->numeric()
                                ->required(),

                            Select::make('vehicle_id')
                                ->required()
                                ->relationship('vehicle', 'plate_number'),
                        ]),
                    Grid::make(2)
                        ->schema([
                            DateTimePicker::make('start_date')
                                ->minutesStep(15)
                                ->withoutSeconds()
                                ->required(),
                            DateTimePicker::make('end_date')
                                ->minutesStep(15)
                                ->withoutSeconds()
                                ->required(),
                        ]),

                    //                    Repeater::make('itineraries')
                    //                            ->relationship()
                    //                            ->schema([
                    //                                Select::make('station_id')
                    //                                      ->required()
                    //                                      ->label('Stop Point')
                    //                                      ->relationship('station','name')
                    //                            ])
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('trip_reference'),
            TextColumn::make('cost')
                ->money('EGP', true),
            TextColumn::make('startingPoint.name'),
            TextColumn::make('endingPoint.name'),
            TextColumn::make('vehicle.plate_number'),
            TextColumn::make('max_seats'),
            TextColumn::make('start_date')
                ->dateTime('d/m/y h:i a'),
            TextColumn::make('end_date')
                ->dateTime('d/m/y h:i a'),

        ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            ItinerariesRelationManager::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
