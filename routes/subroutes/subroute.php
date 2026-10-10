<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/**
 * Register routes for the given items using the specified controller.
 *
 * @param \Illuminate\Support\Collection $items
 * @param string $controllerClass
 * @param string|null $prefix
 */
function registerRoutesForItems($items, string $controllerClass, ?string $prefix = null): void
{
    foreach ($items as $item) {
        $slug = $prefix ? "{$prefix}/{$item->slug}" : $item->slug;

        $reservedSlugs = [
            'contact-us',
            'contact',
            'news-events',
            'our-clubs',
            'gallery',
            'video-gallery',
            'facilities',
        ];

        if (in_array(trim($slug, '/'), $reservedSlugs)) {
            continue;
        }

        Route::get($slug, [$controllerClass, 'common'])->name($slug);
    }
}

if (Schema::hasTable('posts')) {
    $posts = \App\Models\Posts::all();
    if ($posts->isNotEmpty()) {
        registerRoutesForItems($posts, PostController::class, 'post');
    }
}

if (Schema::hasTable('pages')) {
    $pages = \App\Models\Pages::all();
    if ($pages->isNotEmpty()) {
        registerRoutesForItems($pages, PageController::class);
    }
}
