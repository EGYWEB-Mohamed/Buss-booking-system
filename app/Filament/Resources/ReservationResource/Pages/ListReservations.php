<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    protected function getActions(): array
    {
        return [
            //            CreateAction::make(),
        ];
    }
}
