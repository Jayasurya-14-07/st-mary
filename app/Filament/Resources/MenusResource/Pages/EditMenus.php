<?php

namespace App\Filament\Resources\MenusResource\Pages;

use App\Filament\Resources\MenusResource;
use App\Models\Menus;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Validation\ValidationException;

class EditMenus extends EditRecord
{
    protected static string $resource = MenusResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!($data['is_url'] ?? false)) {
            $parentId = $data['parent_id'] ?? null;
            $name = $data['name'] ?? '';

            if (
                Menus::where('parent_id', $parentId)
                    ->where('name', $name)
                    ->whereKeyNot($this->record->getKey())
                    ->exists()
            ) {
                throw ValidationException::withMessages([
                    'data.name' => 'This menu name already exists under the selected parent menu.',
                ]);
            }
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
