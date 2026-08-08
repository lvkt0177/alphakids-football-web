<?php

use App\Http\Controllers\Client\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::post('/dang-ky-hoc-thu', [RegistrationController::class, 'store'])->name('registration.store');