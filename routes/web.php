<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', function ($locale) {
    $supportedLocales = array_column(config('languages.languages'), 'code');
    if (in_array($locale, $supportedLocales)) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

define('FRONTEND_ROUTES_PATH', realpath(__DIR__) . DIRECTORY_SEPARATOR . 'subroutes' . DIRECTORY_SEPARATOR);


Route::get('/', [HomeController::class, 'index']);

Route::get('contact-us', [ContactUsController::class, 'contactUs'])->name('frontend.pages.contactUs');
Route::get('contact', [ContactUsController::class, 'contactUs'])->name('frontend.pages.contact');
Route::post('contact-us', [ContactUsController::class, 'store'])->name('frontend.pages.contactUs.store');
Route::post('contact', [ContactUsController::class, 'store'])->name('frontend.pages.contact.store');
Route::post('registration', [RegistrationController::class, 'store'])->name('frontend.registration.store');

include_once(FRONTEND_ROUTES_PATH . 'subroute.php');

Route::get('news-events', [HomeController::class, 'newsEvents'])->name('frontend.pages.newsEvents');
Route::get('our-clubs', [HomeController::class, 'ourClubs'])->name('frontend.pages.ourClubs');
Route::get('leadership-message/{slug}', [HomeController::class, 'leadershipMessageDetail'])->name('frontend.pages.leadershipMessageDetail');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('frontend.pages.gallery');
// Route::get('/gallery/{year}', [HomeController::class, 'showYearGallery'])->name('gallery.year');
Route::get('/gallery/folder/{slug}', [HomeController::class, 'showGallery'])->name('gallery.show');
Route::get('video-gallery', [HomeController::class, 'videoGallery'])->name('frontend.pages.videoGallery');
Route::get('video-gallery/year/{yearKey}', [HomeController::class, 'videoGalleryYear'])->name('frontend.pages.videoGalleryYear');
Route::get('bishop-column', [HomeController::class, 'bishopColumn'])->name('frontend.pages.bishopColumn');
Route::get('news-events/special-events', [HomeController::class, 'allSpecialEvents'])->name('frontend.pages.allSpecialEvents');
Route::get('news-events/upcoming-events', [HomeController::class, 'allUpcomingEvents'])->name('frontend.pages.allUpcomingEvents');

include_once(FRONTEND_ROUTES_PATH . 'page.php');

Route::get('facilities', [HomeController::class, 'allfacilities'])->name('frontend.pages.allfacilities');
Route::get('facilities/{slug}', [HomeController::class, 'facilityDetail'])->name('frontend.pages.facilityDetail');

Route::fallback(function () {
    $flashNews = \App\Models\FlashNews::where('status', 1)
        ->orderBy('publish_date', 'desc')
        ->get();

    return \Inertia\Inertia::render('Error', [
        'status'    => 404,
        'flashNews' => $flashNews,
    ])
    ->toResponse(request())
    ->setStatusCode(404);
});

