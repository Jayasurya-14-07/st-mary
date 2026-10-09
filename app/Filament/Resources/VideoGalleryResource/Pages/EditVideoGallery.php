<?php

namespace App\Filament\Resources\VideoGalleryResource\Pages;

use App\Filament\Resources\VideoGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVideoGallery extends EditRecord
{
    protected static string $resource = VideoGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}