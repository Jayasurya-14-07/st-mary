<?php

namespace App\Filament\Resources\MenusResource\Pages;

use App\Filament\Resources\MenusResource;
use App\Helpers\Common as Helper;
use App\Models\Menus;
use App\Models\Pages;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateMenus extends CreateRecord
{
    protected static string $resource = MenusResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!($data['is_url'] ?? false)) {
            $parentId = $data['parent_id'] ?? null;
            $name = $data['name'] ?? '';

            if (Menus::where('parent_id', $parentId)->where('name', $name)->exists()) {
                throw ValidationException::withMessages([
                    'data.name' => 'This menu name already exists under the selected parent menu.',
                ]);
            }
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;

        if (!$record->is_url) {
            $slug = $this->makeUniquePageSlug(Helper::getMenuFullPath($record));

            $page = new Pages();

            $page->menu_id = $record->id;
            $page->title = $record->name;
            $page->slug = $slug;
            $page->publish_date = now();

            $page->save();
        }
    }

    protected function makeUniquePageSlug(string $path): string
    {
        $baseSlug = Str::slug(str_replace('/', '-', $path));
        $slug = $baseSlug;
        $count = 2;

        while (Pages::where('slug', $slug)->exists()) {
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
