<?php

namespace App\Filament\Resources\VideoGalleryResource\Pages;

use App\Filament\Resources\VideoGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVideoGallery extends CreateRecord
{
    protected static string $resource = VideoGalleryResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}