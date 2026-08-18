<?php

use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        require __DIR__.'/admin/admin.php';
    });

require __DIR__.'/client/client.php';
require __DIR__.'/auth/auth.php';