<?php

namespace App\Filament\Resources\LeadershipMessageResource\Pages;

use App\Filament\Resources\LeadershipMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeadershipMessage extends EditRecord
{
    protected static string $resource = LeadershipMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
