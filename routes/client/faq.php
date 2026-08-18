<?php

use App\Http\Controllers\Client\FaqController;
use Illuminate\Support\Facades\Route;

Route::get('/cau-hoi-thuong-gap', [FaqController::class, 'index'])->name('faq');