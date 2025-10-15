<?php

namespace App\Livewire\Forms;

use App\Models\ServiceGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServiceGroupForm extends Form
{
    public ?ServiceGroup $service_group;

    #[Validate('required', message: 'Vui lòng nhập tên nhóm dịch vụ/thủ thuật.')]
    public $name = '';
    public $active = 1;
    public $note = '';
    public $clinic_id = '';
    public $last_update_name = '';

    public function store() {
        ServiceGroup::create([
            'name' => $this->name,
            'active' => $this->active,
            'note' => $this->note,
            'clinic_id' => $this->clinic_id,
            'last_update_name' => Auth::user()->username
        ]);

        $this->reset(['name', 'note']);
    }

    public function setAttributes(ServiceGroup $service_group){
        $this->service_group = $service_group;

        $this->name = $service_group->name;
        $this->active = $service_group->active;
        $this->clinic_id = $service_group->clinic_id;
        $this->note = $service_group->note;
    }

    public function update() {
        $this->last_update_name = Auth::user()->username;

        $this->service_group->update(
            $this->only(['name','active','clinic_id','note','last_update_name'])
        );
    }


}
