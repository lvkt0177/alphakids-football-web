<?php

use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('setting')->name('setting.')->group(function () {
    Route::get('/home', [SettingController::class, 'home'])->name('home');
    Route::post('/home/images', [SettingController::class, 'updateImages'])->name('home.images.update');
    Route::post('/home/video', [SettingController::class, 'updateVideo'])->name('home.video.update');
    Route::post('/home/activities', [SettingController::class, 'updateFeaturedActivities'])->name('home.activities.update');

    Route::get('/general', [SettingController::class, 'general'])->name('general');
    Route::post('/general', [SettingController::class, 'updateGeneral'])->name('general.update');
});