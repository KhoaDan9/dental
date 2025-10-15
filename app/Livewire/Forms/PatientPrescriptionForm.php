<?php

namespace App\Livewire\Forms;

use App\Models\PatientPrescription;
use App\Models\PatientService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PatientPrescriptionForm extends Form
{
    public PatientPrescription $patient_prescription;
    public $clinic_id = '';
    public $patient_id = '';
    public $note = '';

    #[Validate('required', message: 'Vui lòng nhập nội dung đơn thuốc.')]
    public $detail = '';
    public $visit_count = '';
    public $last_update_name = '';

    public function store() {
        PatientPrescription::create([
            'clinic_id' => $this->clinic_id,
            'patient_id' => $this->patient_id,
            'note' => $this->note,
            'detail' => $this->detail,
            'last_update_name' => Auth::user()->username,
            'visit_count' => $this->visit_count
        ]);
        $this->reset(['note', 'detail']);
    }

    public function setAttributes(PatientPrescription $patient_prescription){
        $this->patient_prescription = $patient_prescription;

        $this->clinic_id = $patient_prescription->clinic_id;
        $this->patient_id = $patient_prescription->patient_id;
        $this->note = $patient_prescription->note;
        $this->detail = $patient_prescription->detail;
        $this->last_update_name = $patient_prescription->last_update_name;
        $this->visit_count = $patient_prescription->visit_count;
    }

    public function update() {
        $this->last_update_name = Auth::user()->username;
        $this->patient_prescription->update(
            $this->only(['note','detail', 'last_update_name','visit_count'])
        );
    }
}
