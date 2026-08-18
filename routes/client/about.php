<?php

use App\Http\Controllers\Client\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('/ve-clb', [AboutController::class, 'index'])->name('about');