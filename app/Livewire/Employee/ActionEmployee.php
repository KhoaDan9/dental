<?php

namespace App\Livewire\Employee;

use App\Livewire\Forms\EmployeeForm;
use App\Models\Clinic;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
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
    public $errorMessage = '';


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

    public function save()
    {
        $this->form->validate();

        try {
            if ($this->is_create) {
                $this->form->store();
                $this->successMessage = 'Thêm nhân viên thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Sửa thông tin nhân viên thành công!';
            }
        }
        catch (QueryException $e){
            $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }

    }

    public function saveAndExit()
    {
        $this->save();
        if(!$this->errorMessage) {
            $this->redirect('/employees');
        }
    }
    public function render()
    {
        return view('livewire.employee.action-employee');
    }
}
