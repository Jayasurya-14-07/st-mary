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
Route::post('contact-us', [ContactUsController::class, 'store'])->name('frontend.pages.contactUs.store');
Route::post('registration', [RegistrationController::class, 'store'])->name('frontend.registration.store');

include_once(FRONTEND_ROUTES_PATH . 'subroute.php');

Route::get('/gallery', [HomeController::class, 'gallery'])->name('frontend.pages.gallery');
// Route::get('/gallery/{year}', [HomeController::class, 'showYearGallery'])->name('gallery.year');
Route::get('/gallery/folder/{slug}', [HomeController::class, 'showGallery'])->name('gallery.show');
Route::get('video-gallery', [HomeController::class, 'videoGallery'])->name('frontend.pages.videoGallery');
Route::get('bishop-column', [HomeController::class, 'bishopColumn'])->name('frontend.pages.bishopColumn');
Route::get('news-events/special-events', [HomeController::class, 'allSpecialEvents'])->name('frontend.pages.allSpecialEvents');
Route::get('news-events/upcoming-events', [HomeController::class, 'allUpcomingEvents'])->name('frontend.pages.allUpcomingEvents');

include_once(FRONTEND_ROUTES_PATH . 'page.php');

Route::get('facilities', [HomeController::class, 'allfacilities'])->name('frontend.pages.allfacilities');

