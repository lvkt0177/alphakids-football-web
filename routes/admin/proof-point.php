<?php

use App\Http\Controllers\Admin\ProofPointController;
use Illuminate\Support\Facades\Route;

Route::resource('proof-point', ProofPointController::class)->except(['show']);
