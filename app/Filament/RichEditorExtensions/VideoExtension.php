<?php

namespace App\Filament\RichEditorExtensions;

use Tiptap\Core\Node;

class VideoExtension extends Node
{
    public static $name = 'video';

    public function parseHTML()
    {
        return [
            ['tag' => 'video'],
        ];
    }

    public function addAttributes()
    {
        return [
            'src' => [
                'parseHTML' => fn ($DOMNode) => $DOMNode->getAttribute('src'),
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        $src = $HTMLAttributes['src'] ?? '';

        return [
            'video',
            [
                'src' => $src,
                'width' => '100%',
                'style' => 'width: 100%; aspect-ratio: 16 / 9;',
                'controls' => 'controls',
            ],
        ];
    }
}
