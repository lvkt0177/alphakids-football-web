<?php

use App\Http\Controllers\Client\MethodController;
use Illuminate\Support\Facades\Route;

Route::get('/phuong-phap', [MethodController::class, 'index'])->name('method');