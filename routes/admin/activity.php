<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;

Route::resource('activity', ActivityController::class)->except(['show']);

// Uploads a photo or video to temp storage the moment it's picked (so a
// 500MB video never rides in the same request as everything else and can't
// trip post_max_size), but nothing is final until the admin submits the
// form. Not scoped to an {activity} - it has to work before one exists yet
// (the create form), and the temp folder isn't per-activity anyway.
Route::post('activity/media/temp-upload', [ActivityController::class, 'uploadTempMedia'])->name('activity.media.temp-upload');