<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('auth:clear-resets')
    ->hourly()
    ->appendOutputTo(storage_path('logs/reset-password-clean.log'));
