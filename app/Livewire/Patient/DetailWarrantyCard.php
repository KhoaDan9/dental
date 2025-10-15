<?php

namespace App\Livewire\Patient;

use App\Livewire\Forms\WarrantyCardForm;
use App\Models\Patient;
use App\Models\PatientService;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class DetailWarrantyCard extends Component
{
    public WarrantyCardForm $form;
    public $patient_service = '';
    public $patient = '';
    public $successMessage = '';

    public function mount(Patient $patient, PatientService $patient_service)
    {
        $this->patient = $patient;
        $this->form->setAttributes($patient_service);
    }

    public function updateWarrantyCard(){
        $this->form->update();
        $this->successMessage = $this->form->message;
    }

    public function render()
    {
        return view('livewire.patient.detail-warranty-card');
    }
}
