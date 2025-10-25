<?php

namespace App\Livewire\Forms;

use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MaterialForm extends Form
{
    public Material $material;
    public $material_group_id = '';

    #[Validate('required', message: 'Vui lòng nhập tên vật tư.')]
    public $name = '';
    public $describe = '';
    public $caculation_unit = '';
    public $monetary_unit = 'VNĐ';

    #[Validate('required', message: 'Vui lòng nhập đơn giá.')]
    public $price = 0;
    public $note = '';
    public $clinic_id = '';
    public $active = 1;
    public $last_update_name = '';

    public function setAttributes(Material $material)
    {
        $this->material = $material;

        $this->name = $material->name;
        $this->material_group_id = $material->material_group_id;
        $this->describe = $material->describe;
        $this->caculation_unit = $material->caculation_unit;
        $this->monetary_unit = $material->monetary_unit;
        $this->price = number_format((int) $material->price, 0, ',', '.');
        $this->clinic_id = $material->clinic_id;
        $this->active = $material->active;
        $this->note = $material->note;
        $this->last_update_name = $material->last_update_name;
    }

    public function store() {
        Material::create([
            'name' => $this->name,
            'material_group_id' => $this->material_group_id,
            'describe' => $this->describe,
            'caculation_unit' => $this->caculation_unit,
            'monetary_unit' => $this->monetary_unit,
            'price' => (int) str_replace('.','',$this->price),
            'clinic_id' => $this->clinic_id,
            'note' => $this->note,
            'active' => $this->active,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name','note','describe','price']);
    }

    public function update(){
        $this->price = (int) str_replace('.', '', $this->price);
        $this->last_update_name = Auth::user()->username;
        $this->material->update(
            $this->only(['name','note','describe','monetary_unit','caculation_unit','price','clinic_id','active','last_update_name'])
        );
    }
}
