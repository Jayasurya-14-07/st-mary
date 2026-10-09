<?php

namespace App\Filament\Resources\SlidersResource\Pages;

use App\Filament\Resources\SlidersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSliders extends EditRecord
{
    protected static string $resource = SlidersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
