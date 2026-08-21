<?php

use App\Http\Controllers\Admin\AccountController;
use Illuminate\Support\Facades\Route;

Route::prefix('account')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'edit'])->name('edit');
    Route::post('/password', [AccountController::class, 'updatePassword'])->name('password.update');
});
