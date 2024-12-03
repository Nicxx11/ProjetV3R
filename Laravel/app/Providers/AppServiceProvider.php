<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\expirationDelai;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            expirationDelai::class,
        ]);
    }

    public function boot(Schedule $schedule)
    {
        // Scheduling your command every minute
        $schedule->command('fournisseur:expiration-delai')->everyMinute();
    }
}
