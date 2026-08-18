<?php

use App\Http\Controllers\Client\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/chuong-trinh-day', [ProgramController::class, 'index'])->name('program');