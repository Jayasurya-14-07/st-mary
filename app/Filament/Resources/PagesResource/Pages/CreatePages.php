<?php

namespace App\Filament\Resources\PagesResource\Pages;

use App\Filament\Resources\PagesResource;
use App\Helpers\Common as Helper;
use App\Models\Menus;
use App\Models\Pages as PagesModel;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreatePages extends CreateRecord
{
    protected static string $resource = PagesResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = $this->makeUniquePageSlug($data);

        return $data;
    }

    protected function makeUniquePageSlug(array $data): string
    {
        $menu = !empty($data['menu_id']) ? Menus::find($data['menu_id']) : null;
        $base = $menu ? Helper::getMenuFullPath($menu) : ($data['title'] ?? '');
        $baseSlug = Str::slug(str_replace('/', '-', $base));
        $slug = $baseSlug;
        $count = 2;

        while (PagesModel::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
