<?php

namespace App\Observers;

use App\Models\Clinic;
use App\Models\Finance;

class ClinicObserver
{
    /**
     * Handle the Clinic "created" event.
     */
    public function created(Clinic $clinic): void
    {
        Finance::create([
            'name' => "Thu tiền từ bệnh nhân",
            'clinic_id' => $clinic->id,
            'group' => 'Khách hàng',
            'receipt' => 1,
            'active' => 1,
            'last_update_name' => 'admin'
        ]);
    }

    /**
     * Handle the Clinic "updated" event.
     */
    public function updated(Clinic $clinic): void
    {
        //
    }

    /**
     * Handle the Clinic "deleted" event.
     */
    public function deleted(Clinic $clinic): void
    {
        //
    }

    /**
     * Handle the Clinic "restored" event.
     */
    public function restored(Clinic $clinic): void
    {
        //
    }

    /**
     * Handle the Clinic "force deleted" event.
     */
    public function forceDeleted(Clinic $clinic): void
    {
        //
    }
}
