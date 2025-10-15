<?php

namespace App\Livewire\Forms;

use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PrescriptionForm extends Form
{
    public ?Prescription $prescription;

    #[Validate('required', message: 'Vui lòng nhập tên mẫu đơn thuốc mới.')]
    public $name = '';
    public $active = 1;
    public $clinic_id = '';
    public $note = '';
    public $detail = '';
    public $last_update_name = '';

    public function store()
    {
        Prescription::create([
            'name' => $this->name,
            'active' => $this->active,
            'note' => $this->note,
            'detail' => $this->detail,
            'clinic_id' => $this->clinic_id,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name', 'note', 'detail']);
    }

    public function setAttributes(Prescription $prescription)
    {
        $this->prescription = $prescription;

        $this->clinic_id = $prescription->clinic_id;
        $this->name = $prescription->name;
        $this->active = $prescription->active;
        $this->note = $prescription->note;
        $this->detail = $prescription->detail;
        $this->last_update_name = $prescription->last_update_name;
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->prescription->update(
            $this->only(['name', 'clinic_id', 'active', 'note', 'detail', 'last_update_name'])
        );
    }
}
