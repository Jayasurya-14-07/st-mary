<?php

namespace App\Filament\Resources\UpcomingEventsResource\Pages;

use App\Filament\Resources\UpcomingEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUpcomingEvents extends EditRecord
{
    protected static string $resource = UpcomingEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
