<?php

namespace App\Livewire\Forms;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServiceForm extends Form
{
    public ?Service $service;

    #[Validate('required', message: 'Vui lòng nhập tên thủ thuật.')]
    public $name = '';
    // public $bonus = '';
    // public $cost = '';
    public $clinic_id = '';
    public $service_group_id = '';
    public $caculation_unit = '';
//    public $supplier_id = null;
    public $monetary_unit = 'VNĐ';
    public $price = 0;
    public $warranty_able = 1;
    public $warranty = '';
    public $active = 1;
    public $note = '';
    public $last_update_name = '';

    public function setAttributes(Service $service)
    {
        $this->service = $service;

        $this->name = $service->name;
        $this->active = $service->active;
        $this->note = $service->note;
        // $this->bonus = number_format((int) $service->bonus, 0, ',', '.');
        // $this->cost = number_format((int) $service->cost, 0, ',', '.');
        $this->caculation_unit = $service->caculation_unit;
        $this->monetary_unit = $service->monetary_unit;
        $this->price = number_format((int) $service->price, 0, ',', '.');
        $this->warranty_able = $service->warranty_able;
        $this->warranty = $service->warranty;
        $this->service_group_id = $service->service_group_id;
        $this->clinic_id = $service->clinic_id;
//        $this->supplier_id = $service->supplier_id;
        $this->last_update_name = $service->last_update_name;

    }

    public function store()
    {
//        $this->price = (int) str_replace('.', '', $this->price);
//        if($this->supplier_id == '')
//            $this->supplier_id = null;
        // $this->bonus = (int) str_replace('.', '', $this->bonus);
        // $this->cost = (int) str_replace('.', '', $this->cost);

        Service::create([
            'name' => $this->name,
            'active' => $this->active,
            'note' => $this->note,
            // 'bonus' => $this->bonus,
            // 'cost' => $this->cost,
            'caculation_unit' => $this->caculation_unit,
            'monetary_unit' => $this->monetary_unit,
            'price' => (int) str_replace('.','',$this->price),
            'warranty_able' => $this->warranty_able,
            'warranty' => $this->warranty,
            'service_group_id' => $this->service_group_id,
//            'supplier_id' => $this->supplier_id,
            'clinic_id' => $this->clinic_id,
            'last_update_name' => Auth::user()->username
        ]);

        $this->reset(['name', 'active', 'note', 'price']);
    }



    public function update()
    {
        $this->price = (int) str_replace('.', '', $this->price);
//        if($this->supplier_id == '')
//            $this->supplier_id = null;
        $this->last_update_name = Auth::user()->username;

        // $this->price = $this->price;
        // $this->bonus = (int) str_replace('.', '', $this->bonus);
        // $this->cost = (int) str_replace('.', '', $this->cost);

        $this->service->update(
            $this->only(['name', 'active', 'note', 'caculation_unit', 'monetary_unit', 'price', 'warranty_able', 'warranty', 'service_group_id'])
        );
    }
}
