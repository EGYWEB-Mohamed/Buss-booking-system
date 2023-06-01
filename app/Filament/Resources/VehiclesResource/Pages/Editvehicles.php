<?php

namespace App\Filament\Resources\VehiclesResource\Pages;

use App\Filament\Resources\vehiclesResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVehicles extends EditRecord
{
    protected static string $resource = VehiclesResource::class;

    protected function getActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
