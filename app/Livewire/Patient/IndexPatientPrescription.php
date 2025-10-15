<?php

namespace App\Livewire\Patient;

use App\Models\PatientPrescription;
use Livewire\Component;

class IndexPatientPrescription extends Component
{
    public $successMessage = '';
    public $patient_id = '';
    protected $listeners = [
        'refreshIndexPatientPrescription' => '$refresh',
    ];
    public function mount($patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function deletePatientPrescription(PatientPrescription $patient_prescription)
    {
        $patient_prescription->delete();

        $this->successMessage = 'Xóa đơn thuốc thành công';
    }

    public function render()
    {
        $patient_prescriptions = PatientPrescription::where('patient_id', $this->patient_id)->orderBy('created_at','desc')->get();
        return view(
            'livewire.patient.index-patient-prescription',
            [
                'patient_prescriptions' => $patient_prescriptions
            ]
        );
    }
}
