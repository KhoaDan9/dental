<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\PatientPrescriptionForm;
use App\Models\Patient;
use App\Models\PatientPrescription;
use App\Models\PatientService;
use App\Models\Prescription;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class ActionPatientPrescription extends Component
{
    public PatientPrescriptionForm $form;
    public Patient $patient;
    public $patient_prescription = '';
    public $visit_counts = [];
    public $successMessage = '';
    public $errorMessage = '';
    public $is_create = '';

    public function mount(Patient $patient, $value)
    {
        $this->form->clinic_id = $patient->clinic_id;
        $this->form->patient_id = $patient->id;

        $this->visit_counts = PatientService::where('patient_id', $this->patient->id)
            ->groupBy('visit_count')
            ->orderBy('visit_count', 'desc')
            ->pluck('visit_count');

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->visit_count = $this->visit_counts[0];
        } else {
            $patient_prescriptions = PatientPrescription::where('id', $value)->get();
            $this->patient_prescription = $patient_prescriptions[0];
            $this->form->setAttributes($patient_prescriptions[0]);
        }
    }

    public function selectPrescription(Prescription $prescription)
    {
        $this->form->detail = $prescription->detail;
        $this->form->note = $prescription->name;
    }

    public function actionPatientPrescription()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = "Thêm đơn thuốc thành công!";
            } else {
                $this->form->update();
                $this->successMessage = "Sửa đơn thuốc thành công!";
            }
            $this->dispatch('refreshIndexPatientPrescription');
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }

    }

    public function render()
    {
        $prescriptions = Prescription::where('active', 1)->get();
        return view('livewire.patient.action-patient-prescription', [
            'prescriptions' => $prescriptions
        ]);
    }
}
