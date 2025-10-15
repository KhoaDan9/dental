<?php

namespace App\Livewire\Patient;

use App\Models\Appointment;
use Illuminate\Database\QueryException;
use Livewire\Component;

class IndexPatientAppointment extends Component
{
    public $patient_id = '';
    public $successMessage = '';
    public $errorMessage = '';

    protected $listeners = [
        'refreshIndexPatientAppointment' => '$refresh',
    ];
    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function deleteAppointment(Appointment $appointment)
    {
        try {
            $appointment->delete();
            $this->successMessage = 'Xóa lịch hẹn thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa lịch hẹn. Vui lòng thử lại sau!';
        }
    }
    public function render()
    {
        $patient_appointments = Appointment::with('patient')->where('patient_id', $this->patient_id)->orderBy('date','desc')->get();

        return view(
            'livewire.patient.index-patient-appointment',
            [
                'patient_appointments' => $patient_appointments
            ]
        );
    }
}
