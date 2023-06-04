<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Filament\Resources\VehiclesResource\Pages;

use App\Filament\Resources\VehiclesResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicles extends ListRecords
{
    protected static string $resource = VehiclesResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
