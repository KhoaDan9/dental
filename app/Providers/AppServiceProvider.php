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
use Illuminate\Support\Facades\Gate;
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
//        Appointment::observe(AppointmentObserver::class);
//        AccessControl::observe(AccessControlObserver::class);
        Gate::define('view-report-patient-details', function (User $user) {
            return ($user->admin == 1 || $user->accessControls()->where('feature_id', 26)->where('permission_id', 1)->first()->user_permission == '1');
        });

    }
}
