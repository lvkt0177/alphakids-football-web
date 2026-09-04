<?php

use App\Http\Controllers\Admin\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('registration')->name('registration.')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('index');
    Route::get('/export', [RegistrationController::class, 'export'])->name('export');
    Route::get('/{registration}/edit', [RegistrationController::class, 'edit'])->name('edit');
    Route::put('/{registration}', [RegistrationController::class, 'update'])->name('update');
    Route::delete('/{registration}', [RegistrationController::class, 'destroy'])->name('destroy');
});