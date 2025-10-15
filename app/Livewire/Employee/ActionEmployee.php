<?php

namespace App\Livewire\Employee;

use App\Livewire\Forms\EmployeeForm;
use App\Models\Clinic;
use App\Models\Employee;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Danh sách nhân viên')]
class ActionEmployee extends Component
{
    public EmployeeForm $form;
    public Employee $employee;
    public $clinics = [];
    public $is_create = '';
    public $successMessage = '';

    public function mount($value)
    {
        $this->clinics = Clinic::all();
        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->clinic_id = $this->clinics[0]->id;
            $this->form->birth =  Carbon::parse('2000-01-31')->format('Y-m-d');
        } else {
            $this->employee = Employee::where('id', $value)->get()[0];
            $this->form->setAttributes($this->employee);
        }
    }

    public function actionEmployee()
    {
        $this->form->validate();
        if ($this->is_create) {
            $this->form->store();
            $this->successMessage = 'Thêm nhân viên thành công!';
        } else {
            $this->form->update();
            $this->successMessage = 'Sửa thông tin nhân viên thành công!';
        }
    }
    public function render()
    {
        return view('livewire.employee.action-employee');
    }
}
