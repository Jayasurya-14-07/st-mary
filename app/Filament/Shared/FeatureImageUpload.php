<?php

namespace App\Filament\Shared;

use Filament\Forms\Components\FileUpload;

class FeatureImageUpload
{
    public static function make(string $directory, bool $withImageEditor = false, string $name = 'feature_image', ?string $label = null): FileUpload
    {
        $upload = FileUpload::make($name)
            ->disk('public')
            ->visibility('public')
            ->image()
            ->acceptedFileTypes([
                'image/jpeg',
                'image/png',
                'image/webp',
                'image/gif',
            ])
            ->mimeTypeMap([
                'jfif' => 'image/jpeg',
                'pjpeg' => 'image/jpeg',
                'pjp' => 'image/jpeg',
            ])
            ->directory($directory)
            ->imagePreviewHeight('180')
            ->panelLayout('compact')
            ->openable()
            ->downloadable();

        if ($label) {
            $upload->label($label);
        }

        if ($withImageEditor) {
            $upload->imageEditor();
        }

        return $upload;
    }
}
