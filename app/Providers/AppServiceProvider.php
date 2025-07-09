<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdateOrderTracking;
use App\Console\Commands\AddRealisticTracking;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateOrderTracking::class,
                AddRealisticTracking::class,
            ]);
            
            // Schedule automatic tracking updates
            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $schedule->command('orders:update-tracking')
                    ->everyFiveMinutes()
                    ->withoutOverlapping()
                    ->runInBackground();
            });
        }
    }
}
