<?php

namespace App\Livewire\Forms;

use App\Models\MaterialGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MaterialGroupForm extends Form
{
    public MaterialGroup $material_group;

    #[Validate('required', message: 'Vui lòng nhập tên nhóm vật tư.')]
    public $name = '';
    public $note = '';
    public $clinic_id = '';
    public $active = 1;
    public $last_update_name = '';

    public function setAttributes(MaterialGroup $material_group)
    {
        $this->material_group = $material_group;

        $this->name = $material_group->name;
        $this->clinic_id = $material_group->clinic_id;
        $this->active = $material_group->active;
        $this->note = $material_group->note;
        $this->last_update_name = $material_group->last_update_name;

    }

    public function store() {
        MaterialGroup::create([
            'name' => $this->name,
            'note' => $this->note,
            'clinic_id' => $this->clinic_id,
            'active' => $this->active,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name','note']);
    }

    public function update(){
        $this->last_update_name = Auth::user()->username;
        $this->material_group->update(
            $this->only(['name','note','clinic_id','active','last_update_name'])
        );
    }
}
