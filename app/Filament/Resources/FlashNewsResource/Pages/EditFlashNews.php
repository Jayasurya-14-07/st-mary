<?php

namespace App\Filament\Resources\FlashNewsResource\Pages;

use App\Filament\Resources\FlashNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFlashNews extends EditRecord
{
    protected static string $resource = FlashNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
