<?php

namespace App\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Hồ sơ bệnh nhân')]
class EditStatusPatient extends Component
{
    public Patient $patient;
    public $patient_status = '';
    public $successMessage = '';


    public function mount(Patient $patient)
    {
        $this->patient = $patient;

        $this->patient_status = $patient->patient_status;

    }

    public function save()
    {
        $this->patient->update(
            $this->only(['patient_status'])
        );
        $this->successMessage = "Sửa thông tin trạng thái thành công!";
    }

    public function render()
    {
        return view('livewire.patient.edit-status-patient');
    }
}
