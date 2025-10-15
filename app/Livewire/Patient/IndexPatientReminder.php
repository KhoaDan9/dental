<?php

namespace App\Livewire\Patient;

use App\Models\PatientReminder;
use Livewire\Component;

class IndexPatientReminder extends Component
{
    public $successMessage = '';
    public $patient_id = '';
    protected $listeners = [
        'refreshIndexPatientReminder' => '$refresh',
    ];
    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function deletePatientReminder(PatientReminder $patient_reminder)
    {
        $patient_reminder->delete();

        $this->successMessage = 'Xóa lời dặn thành công';
    }

    public function render()
    {
        $patient_reminders = PatientReminder::where('patient_id', $this->patient_id)->orderBy('created_at', 'desc')->get();

        return view(
            'livewire.patient.index-patient-reminder',
            ['patient_reminders' => $patient_reminders]
        );
    }
}
