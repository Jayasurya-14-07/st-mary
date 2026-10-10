<?php

namespace App\Filament\Resources\FacilitySettingResource\Pages;

use App\Filament\Resources\FacilitySettingResource;
use App\Models\FacilitySetting;
use Filament\Resources\Pages\ListRecords;

class ListFacilitySettings extends ListRecords
{
    protected static string $resource = FacilitySettingResource::class;

    public function mount(): void
    {
        $setting = FacilitySetting::firstOrCreate(
            ['id' => 1],
            [
                'kicker' => 'Facilities',
                'title' => 'Facilities for Learning and Growth.',
                'excerpt' => 'St. Mary’s Convent School provides a safe, welcoming, and child-friendly learning environment with facilities that support the academic, physical, creative, and overall development of our students. The school continually strives to provide the resources and opportunities needed to make learning meaningful, engaging, and enjoyable.',
                'images' => [
                    '/images/facilities/facilities1.jpg',
                    '/images/facilities/facilities2.jpg',
                    '/images/facilities/facilities3.jpg',
                    '/images/facilities/facilities4.jpg',
                ],
            ]
        );

        $this->redirect(FacilitySettingResource::getUrl('edit', ['record' => $setting->id]));
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
