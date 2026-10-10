<?php

namespace App\Filament\Resources\FacilitySettingResource\Pages;

use App\Filament\Resources\FacilitySettingResource;
use Filament\Resources\Pages\EditRecord;

class EditFacilitySetting extends EditRecord
{
    protected static string $resource = FacilitySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
