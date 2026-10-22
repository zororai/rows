<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::view('/history', 'pages.history')->name('history');
Route::view('/causes', 'pages.causes')->name('causes');
Route::view('/homes', 'pages.homes')->name('homes');
Route::view('/school', 'pages.school')->name('school');
Route::view('/publications', 'pages.publications')->name('publications');
Route::view('/founder', 'pages.profile')->name('profile');
Route::view('/projects', 'pages.projects')->name('projects');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/donate', 'pages.donate')->name('donate');

Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{story}', [StoryController::class, 'show'])->name('stories.show');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

// Keep links to the old static .html pages working.
$legacyPages = [
    'index' => 'home', 'history' => 'history', 'cause' => 'causes', 'homes' => 'homes',
    'school' => 'school', 'publication' => 'publications', 'profile' => 'profile',
    'projects' => 'projects', 'gallery' => 'gallery', 'test' => 'stories.index',
    'contacts' => 'contact', 'donate' => 'donate',
];

foreach ($legacyPages as $old => $name) {
    Route::get("/{$old}.html", fn () => redirect()->route($name, status: 301));
}

Route::redirect('/testimonials', '/stories', 301);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [Admin\AuthController::class, 'create'])->name('login');
        Route::post('login', [Admin\AuthController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', Admin\DashboardController::class)->name('dashboard');
        Route::post('logout', [Admin\AuthController::class, 'destroy'])->name('logout');
        Route::resource('stories', Admin\StoryController::class)->except('show');
        Route::resource('gallery', Admin\GalleryImageController::class)->except('show');
    });
});
