<?php

namespace App\Filament\Plugins;

use Filament\Forms\Components\RichEditor\Plugins\Contracts\RichContentPlugin;
use Filament\Support\Facades\FilamentAsset;

class TiptapVideoPlugin implements RichContentPlugin
{
    public static function make(): static
    {
        return new static();
    }

    public function getTipTapPhpExtensions(): array
    {
        return [
            new \App\Filament\RichEditorExtensions\YoutubeExtension(),
            new \App\Filament\RichEditorExtensions\VimeoExtension(),
            new \App\Filament\RichEditorExtensions\VideoExtension(),
        ];
    }

    public function getTipTapJsExtensions(): array
    {
        return [
            asset('js/custom-tiptap-video.js?v=' . time()),
        ];
    }

    public function getEditorTools(): array
    {
        return [];
    }

    public function getEditorActions(): array
    {
        return [];
    }
}
