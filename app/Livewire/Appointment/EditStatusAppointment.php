<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\Patient;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Quản lý lịch hẹn')]
class EditStatusAppointment extends Component
{
    public Appointment $appointment;
    public Patient $patient;
    public $appointment_status = '';
    public $successMessage = '';

    public function updateStatusAppointment()
    {
        $this->appointment->update(
            [
                'status' => $this->appointment_status
            ]
        );

        $this->successMessage = "Sửa thông tin trạng thái hẹn thành công!";
    }
    public function mount(Patient $patient, Appointment $appointment)
    {
        $this->$appointment = $appointment;
        $this->$patient = $patient;

        $this->appointment_status = $appointment->status;
    }

    public function render()
    {

        return view(
            'livewire.appointment.edit-status-appointment');
    }
}
