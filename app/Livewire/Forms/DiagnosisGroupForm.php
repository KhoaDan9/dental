<?php

namespace App\Livewire\Forms;

use App\Models\DiagnosisGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DiagnosisGroupForm extends Form
{
    public ?DiagnosisGroup $diagnosis_group;

    #[Validate('required', message: 'Vui lòng nhập tên nhóm chẩn đoán.')]
    public $name = '';
    public $active = 1;
    public $note = '';
    public $clinic_id = '';
    public $last_update_name = '';


    public function store() {
        DiagnosisGroup::create([
            'name' => $this->name,
            'active' => $this->active,
            'note' => $this->note,
            'clinic_id' => $this->clinic_id,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name', 'note']);
    }

    public function setAttributes(DiagnosisGroup $diagnosis_group){
        $this->diagnosis_group = $diagnosis_group;

        $this->name = $diagnosis_group->name;
        $this->clinic_id = $diagnosis_group->clinic_id;
        $this->active = $diagnosis_group->active;
        $this->note = $diagnosis_group->note;
    }

    public function update() {
        $this->last_update_name = Auth::user()->username;
        $this->diagnosis_group->update(
            $this->only(['name','active','note','clinic_id', 'last_update_name'])
        );
    }


}
