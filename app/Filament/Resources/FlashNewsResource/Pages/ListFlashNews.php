<?php

namespace App\Filament\Resources\FlashNewsResource\Pages;

use App\Filament\Resources\FlashNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFlashNews extends ListRecords
{
    protected static string $resource = FlashNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
