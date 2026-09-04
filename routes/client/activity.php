<?php

use App\Http\Controllers\Client\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/hoat-dong-su-kien', [ActivityController::class, 'index'])->name('activity.index');