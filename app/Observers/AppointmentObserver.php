<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\DataLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentObserver
{
    public function createLog(Appointment $appointment, $action)
    {
        $user_id = Auth::user()->id;
        $date = Carbon::parse($appointment->date)->format('d/m/Y');
        $time = Carbon::parse($appointment->date)->format('H:i');
        $detail = "Họ tên: " . $appointment->patient->name . "; Ngày hẹn: $date; Giờ hẹn: $time; Trạng thái: $appointment->status;
            Nội dung hẹn: $appointment->detail; Nhân viên: $appointment->employee->name; Ghi chú: $appointment->note";

        DataLog::create([
            'clinic_id' => $appointment->clinic_id,
            'user_id' => $user_id,
            'action' => $action,
            'action_id' => $appointment->id,
            'group_action' => "Lịch hẹn",
            'detail' => $detail
        ]);
    }
    /**
     * Handle the Appointment "created" event.
     */
    public function created(Appointment $appointment): void
    {
        $this->createLog($appointment, "Thêm");
    }

    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        $this->createLog($appointment, "Sửa");
    }

    /**
     * Handle the Appointment "deleted" event.
     */
    public function deleted(Appointment $appointment): void
    {
        $this->createLog($appointment, "Xóa");
    }

    /**
     * Handle the Appointment "restored" event.
     */
    public function restored(Appointment $appointment): void
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     */
    public function forceDeleted(Appointment $appointment): void
    {
        //
    }
}
