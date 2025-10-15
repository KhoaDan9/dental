<?php

namespace App\Livewire\Forms;

use App\Models\Diagnosis;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DiagnosisForm extends Form
{
    public Diagnosis $diagnosis;

    #[Validate('required', message: 'Vui lòng nhập tên mẫu chẩn đoán.')]
    public $name = '';
    public $active = 1;
    public $clinic_id = '';
    public $note = '';
    public $last_update_name = '';
    public $diagnosis_group_id = '';

    public function store() {
        Diagnosis::create([
            'name' => $this->name,
            'active' => $this->active,
            'note' => $this->note,
            'clinic_id' => $this->clinic_id,
            'diagnosis_group_id' => $this->diagnosis_group_id,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name', 'note']);
    }

    public function setAttributes(Diagnosis $diagnosis){
        $this->diagnosis = $diagnosis;

        $this->clinic_id = $diagnosis->clinic_id;
        $this->name = $diagnosis->name;
        $this->active = $diagnosis->active;
        $this->diagnosis_group_id = $diagnosis->diagnosis_group_id;
        $this->note = $diagnosis->note;
        $this->last_update_name = $diagnosis->last_update_name;
    }

    public function update() {
        $this->last_update_name = Auth::user()->username;
        $this->diagnosis->update(
            $this->only(['name','active', 'clinic_id','note','diagnosis_group_id', 'last_update_name'])
        );
    }


}
