<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Resources\TripResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrips extends ListRecords
{
    protected static string $resource = TripResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
