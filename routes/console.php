<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Requires the server cron to call `php artisan schedule:run` every minute
// (standard Laravel setup) - without that this never actually fires.
Schedule::command('activity:cleanup-gallery-temp')->daily();
