<?php

namespace App\Helpers;

use App\Models\Menus;
use App\Models\SocialIcons;
use Auth;
use Awcodes\Curator\Models\Media;
use Carbon\Carbon;
use Config;
use DB;
use Illuminate\Support\Str;

class Common
{

    /**
     * Replace the null value with empty
     *
     * @return
     */

    // public static function getMenus()
    // {
    //     $menus = Menus::where('type', 'main_menu')->where('status', 1)->orderBy('order_by', 'asc')->get();

    //     $menus->load('children');

    //     return $menus;
    // }

    public static function getMenus()
    {
        $menus = Menus::where(function($q) {
                $q->whereNull('parent_id')
                  ->orWhere('parent_id', 0)
                  ->orWhere('parent_id', -1)
                  ->orWhere('type', 'main_menu');
            })
            ->where('status', 1)
            ->orderByRaw('order_by IS NULL')
            ->orderBy('order_by', 'asc')
            ->orderBy('id', 'asc')
            ->with('allChildren')  // Eager load recursively
            ->get();
        
        return $menus;
    }



    public static function formatMenusForInertia($menus)
    {
        if (!$menus) {
            return [];
        }

        static $dynamicFacilities = null;

        return $menus->map(function ($menu) use (&$dynamicFacilities) {
            $children = ($menu->allChildren && $menu->allChildren->isNotEmpty())
                ? self::formatMenusForInertia($menu->allChildren)
                : [];

            $isFacilities = strtolower(trim($menu->name ?? '')) === 'facilities'
                || trim((string) ($menu->url ?? ''), '/') === 'facilities';

            if ($isFacilities && empty($children)) {
                if ($dynamicFacilities === null) {
                    $dynamicFacilities = \App\Models\Facility::where('status', 1)
                        ->orderBy('order_by', 'asc')
                        ->get()
                        ->map(function ($f) {
                            return [
                                'id'           => 'facility-' . $f->id,
                                'name'         => $f->title,
                                'is_url'       => true,
                                'url'          => '/facilities/' . $f->slug,
                                'target'       => '_self',
                                'all_children' => [],
                            ];
                        })
                        ->toArray();
                }
                $children = $dynamicFacilities;
            }

            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'is_url' => (bool) $menu->is_url,
                'url' => (!empty($children) && $isFacilities) ? '#' : self::getMenuUrl($menu),
                'target' => ($menu->is_url && $menu->target) ? $menu->target : '_self',
                'all_children' => $children,
            ];
        })->toArray();
    }

    public static function getImage($image)
    {
        $data = Media::find($image);

        return $data->path;
    }

    public static function getSocialIcons()
    {
        return SocialIcons::where('status', 1)->get();
    }

    public static function getMenuFullPath($menu)
    {
        $segments = [];

        while ($menu) {
            $segments[] = Str::slug($menu->name);
            $menu = $menu->parent;
        }

        return implode('/', array_reverse($segments));
    }

    public static function getMenuUrlPath($menu)
    {
        if (!$menu->page) {
            return null;
        }

        return self::getMenuFullPath($menu);
    }

    public static function getMenuUrl($menu)
    {
        if ($menu->is_url) {
            return $menu->url;
        }

        $path = self::getMenuUrlPath($menu);

        return $path ? url($path) : '#';
    }

    public static function renderRichContent(mixed $content): string
    {
        if (blank($content)) {
            return '';
        }

        if (is_array($content)) {
            return self::renderTiptapNode($content);
        }

        if (is_string($content)) {
            $decodedJson = json_decode($content, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedJson)) {
                return self::renderTiptapNode($decodedJson);
            }
        }

        $content = self::fixTextEncoding(html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8'));

        $content = preg_replace_callback('/<iframe\b[^>]*\bsrc=(["\'])(.*?)\1[^>]*><\/iframe>/i', function (array $matches): string {
            $src = self::toEmbedUrl($matches[2]);

            if (! $src) {
                return '';
            }

            return '<div class="tiptap-video-wrapper mb-3"><iframe src="' . e($src) . '" allowfullscreen width="100%" height="100%" style="border-radius: 8px; border: none;"></iframe></div>';
        }, $content);

        $content = preg_replace_callback('/<video\b[^>]*\bsrc=(["\'])(.*?)\1[^>]*>.*?<\/video>/is', function (array $matches): string {
            return self::renderVideo($matches[2]);
        }, $content);

        return preg_replace_callback('/<img\b([^>]*)\bsrc=(["\'])(.*?)\2([^>]*)>/i', function (array $matches): string {
            $src = $matches[3];
            $alt = '';

            if (preg_match('/\salt=(["\'])(.*?)\1/i', $matches[0], $altMatch)) {
                $alt = $altMatch[2];
            }

            return self::renderImage($src, $alt);
        }, $content);
    }

    protected static function renderTiptapNode(mixed $node): string
    {
        if (! is_array($node)) {
            return '';
        }

        if (array_is_list($node)) {
            return collect($node)->map(fn ($child): string => self::renderTiptapNode($child))->implode('');
        }

        $type = $node['type'] ?? null;
        $attrs = $node['attrs'] ?? [];
        $children = collect($node['content'] ?? [])->map(fn ($child): string => self::renderTiptapNode($child))->implode('');

        return match ($type) {
            'doc' => $children,
            'paragraph' => filled(trim(strip_tags($children, '<img><iframe><video><br>'))) ? '<p>' . $children . '</p>' : $children,
            'text' => self::renderTiptapText($node),
            'hardBreak' => '<br>',
            'heading' => '<h' . max(1, min(6, (int) ($attrs['level'] ?? 2))) . ' class="section-heading">' . $children . '</h' . max(1, min(6, (int) ($attrs['level'] ?? 2))) . '>',
            'bulletList' => '<ul>' . $children . '</ul>',
            'orderedList' => '<ol>' . $children . '</ol>',
            'listItem' => '<li>' . $children . '</li>',
            'blockquote' => '<blockquote>' . $children . '</blockquote>',
            'image' => self::renderImage($attrs['src'] ?? '', $attrs['alt'] ?? ''),
            'video' => self::renderVideo($attrs['src'] ?? ''),
            'youtube', 'vimeo' => self::renderIframe($attrs['src'] ?? ''),
            default => $children,
        };
    }

    protected static function renderTiptapText(array $node): string
    {
        $text = e($node['text'] ?? '');

        foreach ($node['marks'] ?? [] as $mark) {
            $type = $mark['type'] ?? null;
            $attrs = $mark['attrs'] ?? [];

            $text = match ($type) {
                'bold' => '<strong>' . $text . '</strong>',
                'italic' => '<em>' . $text . '</em>',
                'underline' => '<u>' . $text . '</u>',
                'strike' => '<s>' . $text . '</s>',
                'link' => '<a href="' . e($attrs['href'] ?? '#') . '"' . (($attrs['target'] ?? null) === '_blank' ? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . $text . '</a>',
                default => $text,
            };
        }

        return $text;
    }

    protected static function renderImage(?string $src, ?string $alt = ''): string
    {
        if (blank($src)) {
            return '';
        }

        $src = self::normalizeMediaUrl($src);

        return '<a href="' . e($src) . '" class="popup-image"><img src="' . e($src) . '" class="img-fluid rounded mb-3" alt="' . e($alt ?? '') . '"></a>';
    }

    protected static function renderIframe(?string $src): string
    {
        $src = self::toEmbedUrl($src);

        if (! $src) {
            return '';
        }

        return '<div class="tiptap-video-wrapper mb-3"><iframe src="' . e($src) . '" allowfullscreen width="100%" height="100%" style="border-radius: 8px; border: none;"></iframe></div>';
    }

    protected static function renderVideo(?string $src): string
    {
        if (blank($src)) {
            return '';
        }

        $embedUrl = self::toEmbedUrl($src);

        if ($embedUrl && (str_contains($embedUrl, 'youtube.com/embed/') || str_contains($embedUrl, 'player.vimeo.com/video/'))) {
            return self::renderIframe($embedUrl);
        }

        $src = self::normalizeMediaUrl($src);

        return '<video src="' . e($src) . '" controls style="width: 100%; aspect-ratio: 16 / 9; border-radius: 8px;" class="mb-3"></video>';
    }

    protected static function normalizeMediaUrl(?string $url): string
    {
        $url = html_entity_decode((string) $url, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (Str::startsWith($url, ['http://', 'https://', '/'])) {
            return $url;
        }

        return asset('storage/' . ltrim($url, '/'));
    }

    public static function fixTextEncoding(?string $content): string
    {
        if (blank($content)) {
            return '';
        }

        return strtr($content, [
            'â€˜' => "'",
            'â€™' => "'",
            'â€œ' => '"',
            'â€' => '"',
            'â€“' => '-',
            'â€”' => '-',
            'â€¦' => '...',
            'â€¢' => '&bull;',
            'Â ' => ' ',
            'Â' => '',
        ]);
    }

    public static function renderContentBlocks(?array $blocks, ?string $fallbackTitle = null): string
    {
        if (empty($blocks)) {
            return '';
        }

        $html = '';

        foreach ($blocks as $block) {
            $type = $block['type'] ?? '';
            $data = $block['data'] ?? [];
            $content = data_get($data, 'content');
            $url = data_get($data, 'url');
            $alt = e(data_get($data, 'alt', $fallbackTitle ?? ''));

            $html .= '<div class="block-item">';

            switch ($type) {
                case 'heading':
                    $level = in_array(data_get($data, 'level'), ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true)
                        ? data_get($data, 'level')
                        : 'h3';
                    $html .= "<{$level} class=\"section-heading\">" . e($content) . "</{$level}>";
                    break;

                case 'Rich Editor':
                case 'Tip tap editor':
                case 'TipTap Editor':
                case 'tiptap':
                    $html .= '<div class="content-text tiptap-content mb-3">' . self::renderRichContent($content) . '</div>';
                    break;

                case 'image':
                    if ($url) {
                        $imageUrl = asset('storage/' . $url);
                        $html .= '<a href="' . e($imageUrl) . '" class="popup-image"><img src="' . e($imageUrl) . '" class="img-fluid rounded" alt="' . $alt . '"></a>';
                    }
                    break;

                case 'video':
                case 'iframe':
                    $embedUrl = self::toEmbedUrl($url);
                    if ($embedUrl) {
                        $html .= '<div class="tiptap-video-wrapper mb-3"><iframe src="' . e($embedUrl) . '" allowfullscreen width="100%" height="100%" style="border-radius: 8px; border: none;"></iframe></div>';
                    }
                    break;

                case 'button':
                    if ($url) {
                        $target = data_get($data, 'open_in_new_tab') ? ' target="_blank" rel="noopener noreferrer"' : '';
                        $html .= '<a href="' . e($url) . '" class="btn btn-primary"' . $target . '>' . e(data_get($data, 'text', 'Click Here')) . '</a>';
                    }
                    break;
            }

            $html .= '</div>';
        }

        return $html;
    }

    public static function toEmbedUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $url = html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts|live)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return "https://www.youtube.com/embed/{$match[1]}";
        }

        if (preg_match('%^https?://(?:www\.|player\.)?vimeo.com/(?:channels/(?:\w+/)?|groups/([^/]*)/videos/|album/(\d+)/video/|video/|)(\d+)(?:$|/|\?)%i', $url, $match)) {
            return "https://player.vimeo.com/video/{$match[3]}";
        }

        return filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
    }
}

