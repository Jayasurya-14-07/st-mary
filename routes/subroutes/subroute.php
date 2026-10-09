<?php
use App\Http\Controllers\OurActivitiesController;
use App\Http\Controllers\OurLeadersController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ToppersXController;
use App\Http\Controllers\ToppersXIIController;
use App\Http\Controllers\NoticesCircularsController;
use App\Http\Controllers\UpcomingEventsController;
use App\Http\Controllers\CampusLifeController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\CelebrationController;
use App\Http\Controllers\LivesOfSaintController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

        if ($slug === 'contact-us') {
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

if (Schema::hasTable('notices_circulars')) {
    $items = \App\Models\NoticesCirculars::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, NoticesCircularsController::class, 'notices-circulars');
    }
}

if (Schema::hasTable('upcoming_events')) {
    $items = \App\Models\UpcomingEvents::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, UpcomingEventsController::class, 'upcoming-events');
    }
}

if (Schema::hasTable('campus_life')) {
    $items = \App\Models\CampusLife::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, CampusLifeController::class, 'campus-life');
    }
}

if (Schema::hasTable('sports')) {
    $items = \App\Models\Sports::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, SportsController::class, 'sports');
    }
}

if (Schema::hasTable('events')) {
    $items = \App\Models\Events::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, EventsController::class, 'events');
    }
}

if (Schema::hasTable('activities')) {
    $items = \App\Models\Activities::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, ActivitiesController::class, 'activities');
    }
}

if (Schema::hasTable('celebrations')) {
    $items = \App\Models\Celebration::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, CelebrationController::class, 'celebrations');
    }
}

if (Schema::hasTable('news')) {
    $items = \App\Models\News::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, NewsController::class, 'news');
    }
}

if (Schema::hasTable('lives_of_saints')) {
    $items = \App\Models\LivesOfSaint::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, LivesOfSaintController::class, 'lives-of-saints');
    }
}

if (Schema::hasTable('testimonials')) {
    $items = \App\Models\Testimonial::all();
    if ($items->isNotEmpty()) {
        registerRoutesForItems($items, TestimonialController::class, 'testimonials');
    }
}
