<?php

namespace App\Livewire\Forms;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplierForm extends Form
{
    public Supplier $supplier;

    #[Validate('required', message: 'Vui lòng nhập tên nhà cung cấp.')]
    public $name = '';
    public $clinic_id = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $active = 1;
    public $last_update_name = '';
    public $note = '';

    public function store() {
        Supplier::create([
            'name' => $this->name,
            'clinic_id' => $this->clinic_id,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'active' => $this->active,
            'note' => $this->note,
            'last_update_name' => Auth::user()->username
        ]);

        $this->reset(['name', 'active', 'note','address','clinic_id','phone','email']);
    }

    public function setAttributes(Supplier $supplier){
        $this->supplier = $supplier;

        $this->name = $supplier->name;
        $this->clinic_id = $supplier->clinic_id;
        $this->address = $supplier->address;
        $this->phone = $supplier->phone;
        $this->email = $supplier->email;
        $this->last_update_name = $supplier->last_update_name;
        $this->active = $supplier->active;
        $this->note = $supplier->note;
    }

    public function update() {
        $this->last_update_name = Auth::user()->username;
        $this->supplier->update(
            $this->only(['name', 'active', 'note','address','clinic_id','phone','email'])
        );
    }
}
