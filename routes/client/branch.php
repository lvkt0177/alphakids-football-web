<?php

use App\Http\Controllers\Client\BranchController;
use Illuminate\Support\Facades\Route;

Route::get('/he-thong-co-so', [BranchController::class, 'index'])->name('branch.index');