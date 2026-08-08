<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        require __DIR__.'/admin/admin.php';
    });

require __DIR__.'/client/client.php';
require __DIR__.'/auth/auth.php';