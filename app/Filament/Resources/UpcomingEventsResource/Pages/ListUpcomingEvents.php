<?php

namespace App\Filament\Resources\UpcomingEventsResource\Pages;

use App\Filament\Resources\UpcomingEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUpcomingEvents extends ListRecords
{
    protected static string $resource = UpcomingEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
