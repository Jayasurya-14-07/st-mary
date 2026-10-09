<?php

namespace App\Filament\RichEditorExtensions;

use Tiptap\Core\Node;

class YoutubeExtension extends Node
{
    public static $name = 'youtube';

    public function parseHTML()
    {
        return [
            ['tag' => 'div[data-youtube-video] iframe'],
            ['tag' => 'iframe[src*="youtube.com"]'],
            ['tag' => 'iframe[src*="youtu.be"]'],
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
        
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts|live)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $src, $match)) {
            $src = "https://www.youtube.com/embed/{$match[1]}";
        }

        return [
            'div',
            [
                'data-youtube-video' => '',
                'class' => 'tiptap-youtube-wrapper',
                'style' => 'position: relative; width: 100%; aspect-ratio: 16 / 9; margin: 1rem 0;',
            ],
            [
                'iframe',
                [
                    'src' => $src,
                    'width' => '100%',
                    'height' => '100%',
                    'style' => 'position: absolute; top: 0; left: 0; width: 100%; height: 100%;',
                    'frameborder' => '0',
                    'allow' => 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
                    'allowfullscreen' => 'allowfullscreen',
                ],
            ],
        ];
    }
}
