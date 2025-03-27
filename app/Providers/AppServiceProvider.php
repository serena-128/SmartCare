<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Event;
use App\Observers\EventObserver;
use App\Models\Appointment;
use App\Observers\AppointmentObserver;
use App\Models\News;
use App\Observers\NewsObserver;
use App\Models\Bulletin;
use App\Observers\BulletinObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Event::observe(EventObserver::class);
       Appointment::observe(AppointmentObserver::class); 
        News::observe(NewsObserver::class);
        Bulletin::observe(BulletinObserver::class);
    }
}
