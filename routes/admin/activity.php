<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;

Route::resource('activity', ActivityController::class)->except(['show']);