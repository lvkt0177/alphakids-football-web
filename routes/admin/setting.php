<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('setting')->name('setting.')->group(function () {
    Route::get('/home', [SettingController::class, 'home'])->name('home');
    Route::post('/home/images', [SettingController::class, 'updateImages'])->name('home.images.update');
    Route::post('/home/video', [SettingController::class, 'updateVideo'])->name('home.video.update');
    Route::delete('/home/video', [SettingController::class, 'deleteVideo'])->name('home.video.delete');
    Route::post('/home/activities', [SettingController::class, 'updateFeaturedActivities'])->name('home.activities.update');

    Route::get('/other-pages', [SettingController::class, 'otherPages'])->name('other-pages');
    Route::post('/other-pages/images', [SettingController::class, 'updateImages'])->name('other-pages.images.update');
    Route::post('/other-pages/about-letter', [SettingController::class, 'updateAboutLetter'])->name('other-pages.about-letter.update');

    Route::get('/general', [SettingController::class, 'general'])->name('general');
    Route::post('/general', [SettingController::class, 'updateGeneral'])->name('general.update');
});
