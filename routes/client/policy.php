<?php

use App\Http\Controllers\Client\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;

Route::get('/chinh-sach-bao-mat-du-lieu-ca-nhan', [PrivacyPolicyController::class, 'index'])->name('policy.privacy');
