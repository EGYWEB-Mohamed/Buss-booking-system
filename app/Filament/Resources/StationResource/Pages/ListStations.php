<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Filament\Resources\StationResource\Pages;

use App\Filament\Resources\StationResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStations extends ListRecords
{
    protected static string $resource = StationResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
