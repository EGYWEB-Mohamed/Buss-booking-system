<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Filament\Resources;

use App\Filament\Resources\VehiclesResource\Pages;
use App\Models\Vehicles;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class VehiclesResource extends Resource
{
    protected static ?string $model = Vehicles::class;

    protected static ?string $slug = 'vehicles';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('driver_name')
                ->required(),
            TextInput::make('plate_number')
                ->required(),
            TextInput::make('max_seats')
                ->numeric()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('plate_number'),
            TextColumn::make('driver_name'),
            TextColumn::make('max_seats'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicles::route('/create'),
            'edit' => Pages\EditVehicles::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
