<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;

Route::resource('activity', ActivityController::class)->except(['show']);

// Uploads a photo to temp storage the moment it's picked (so a 30MB photo
// never rides in the same request as everything else and can't trip
// post_max_size), but nothing is final until the admin submits the form.
Route::post('activity/{activity}/images/temp-upload', [ActivityController::class, 'uploadTempImage'])->name('activity.images.temp-upload');