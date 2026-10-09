<?php

namespace App\Filament\RichEditorExtensions;

use Tiptap\Core\Node;

class VimeoExtension extends Node
{
    public static $name = 'vimeo';

    public function parseHTML()
    {
        return [
            ['tag' => 'div[data-vimeo-video] iframe'],
            ['tag' => 'iframe[src*="vimeo.com"]'],
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
        
        if (preg_match('%^https?://(?:www\.|player\.)?vimeo.com/(?:channels/(?:\w+/)?|groups/([^/]*)/videos/|album/(\d+)/video/|video/|)(\d+)(?:$|\/|\?)%i', $src, $match)) {
            $src = "https://player.vimeo.com/video/{$match[3]}";
        }

        return [
            'div',
            [
                'data-vimeo-video' => '',
                'class' => 'tiptap-vimeo-wrapper',
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
                    'allow' => 'autoplay; fullscreen; picture-in-picture',
                    'allowfullscreen' => 'allowfullscreen',
                ],
            ],
        ];
    }
}
