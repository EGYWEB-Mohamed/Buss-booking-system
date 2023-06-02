<?php

namespace App\Filament\Resources\TripResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ItinerariesRelationManager extends RelationManager
{
    protected static string $relationship = 'itineraries';

    protected static ?string $title = 'Stations Itineraries';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(1)->schema([
                Forms\Components\Select::make('station_id')
                    ->label('Select Station')
                    ->relationship('station', 'name')
                    ->required(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('station.name')->label('Stations'),
        ])
            ->filters([//
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Assign New Station'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('sort')
            ->defaultSort('sort');
    }
}
