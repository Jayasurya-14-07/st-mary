<?php

namespace App\Filament\Resources\MenusResource\Pages;

use App\Filament\Resources\MenusResource;
use SolutionForest\FilamentTree\Resources\Pages\TreePage;

class ListMenuses extends TreePage
{
    protected static string $resource = MenusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            $this->getCreateAction(),
        ];
    }
}
