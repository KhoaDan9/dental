<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeForm extends Form
{
    public ?Employee $employee;

    #[Validate('required', message: 'Vui lòng nhập tên nhân viên.')]
    public $name = '';
    public $full_name = '';
    public $phone = '';
    public $address = '';
    public $citizen_id = '';
    public $clinic_id = '';
    public $email = '';
    public $birth = '';
    public $note = '';
    public $doctor = false;
    public $last_update_name = '';
    public $active = true;

    public function store()
    {
        Employee::create([
            'name' =>  $this->name,
            'full_name' => $this->full_name,
            'clinic_id' => $this->clinic_id,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
            'citizen_id' => $this->citizen_id,
            'birth' => $this->birth,
            'note' => $this->note,
            'doctor' => $this->doctor,
            'last_update_name' => Auth::user()->username,
            'active' => $this->active,
        ]);
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->employee->update(
            $this->only(['name', 'clinic_id',  'full_name', 'birth', 'phone', 'email', 'doctor', 'citizen_id', 'last_update_name', 'active', 'address', 'note'])
        );
    }

    public function setAttributes(employee $employee)
    {
        $this->employee = $employee;

        $this->name =  $employee->name;
        $this->full_name = $employee->full_name;
        $this->clinic_id = $employee->clinic_id;
        $this->phone = $employee->phone;
        $this->address = $employee->address;
        $this->email = $employee->email;
        $this->citizen_id = $employee->citizen_id;
        $this->birth = $employee->birth;
        $this->note = $employee->note;
        $this->doctor = $employee->doctor;
        $this->last_update_name = $employee->last_update_name;
        $this->active = $employee->active;
    }
}
