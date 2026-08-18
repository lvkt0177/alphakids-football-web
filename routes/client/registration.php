<?php

use App\Http\Controllers\Client\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/lien-he-dang-ky-hoc-thu', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/dang-ky-hoc-thu', [RegistrationController::class, 'store'])->name('registration.store');
Route::post('/dang-ky-nhanh', [RegistrationController::class, 'quickStore'])->name('registration.quick-store');