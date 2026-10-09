<?php

namespace App\Filament\Resources\SlidersResource\Pages;

use App\Filament\Resources\SlidersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSliders extends CreateRecord
{
    protected static string $resource = SlidersResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}