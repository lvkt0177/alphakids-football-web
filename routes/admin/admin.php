<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    include 'branch.php';
    include 'activity.php';
    include 'faq.php';
    include 'registration.php';
    include 'setting.php';

});
