<?php

use App\Http\Controllers\Admin\FaqController;
use Illuminate\Support\Facades\Route;

Route::resource('faq', FaqController::class)->except(['show']);
