<?php

namespace App\Providers;

use App\Models\AccessControl;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\User;
use App\Observers\AccessControlObserver;
use App\Observers\AppointmentObserver;
use App\Observers\ClinicObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

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
        User::observe(UserObserver::class);
        Clinic::observe(ClinicObserver::class);
        Appointment::observe(AppointmentObserver::class);
        AccessControl::observe(AccessControlObserver::class);


    }
}
