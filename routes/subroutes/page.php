<?php

use App\Http\Controllers\PageController;
use App\Models\Pages;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use App\Helpers\Common as Helper;

if (Schema::hasTable('pages')) {

    // Eager load menu and its ancestors for nested menu URLs.
    $pages = Pages::with('menu.parent.parent.parent.parent')->get();

    foreach ($pages as $page) {
        $menu = $page->menu;

        if (!$menu) {
            continue; // Skip pages with no associated menu
        }

        $fullPath = Helper::getMenuUrlPath($menu);

        if (!$fullPath) {
            continue;
        }

        $reservedPaths = [
            'contact-us',
            'contact',
            'news-events',
            'our-clubs',
            'gallery',
            'video-gallery',
            'facilities',
        ];

        if (in_array(trim($fullPath, '/'), $reservedPaths)) {
            continue;
        }


        // Register the route
        Route::get($fullPath, [PageController::class, 'common'])
            ->defaults('page_id', $page->id)
            ->name("pages.$page->slug");
    }
}
