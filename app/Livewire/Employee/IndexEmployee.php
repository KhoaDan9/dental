<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Danh sách nhân viên')]
class IndexEmployee extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteEmployee(Employee $employee)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $employee->delete();
            $this->successMessage = 'Xóa nhân viên thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa nhân viên! Vui lòng liên hệ với chúng tôi.';
        }
    }
    public function render()
    {
        $employees = Employee::get();

        return view('livewire.employee.index-employee', [
            'employees' => $employees
        ]);
    }
}
