<?php

use App\Http\Controllers\Admin\BranchController;
use Illuminate\Support\Facades\Route;

Route::resource('branch', BranchController::class)->except(['show']);