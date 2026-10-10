<?php

namespace App\Filament\Resources\LeadershipMessageResource\Pages;

use App\Filament\Resources\LeadershipMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeadershipMessages extends ListRecords
{
    protected static string $resource = LeadershipMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
