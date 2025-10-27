<?php

namespace App\Livewire\Security\UserManagement;

use App\Livewire\Forms\UserForm;
use App\Models\Clinic;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ActionUser extends Component
{
    public UserForm $form;
    public User $user;
    public $clinics = [];
    public $employees = [];
    public $successMessage = '';
    public $errorMessage = '';
    public $is_create = '';

    public function mount($value)
    {
        $this->clinics = Clinic::all();
        $this->employees = Employee::all();

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->clinic_id = $this->clinics[0]->id;
            $this->form->employee_id = $this->employees[0]->id;
            $this->form->date_permission = Carbon::today()->toDateString();
        } else {
            $this->user = User::findOrFail($value);
            $this->form->setAttributes($this->user);
        }
    }
    public function save()
    {
        $this->form->validate();
        $this->errorMessage = '';
        try {
            if ($this->is_create == 'create') {
                if (User::where('username', $this->form->username)->exists())
                    return $this->errorMessage = 'Tài khoản đã tồn tại, xin vui lòng sử dụng tên tài khoản khác!';

                $this->form->store();
                $this->successMessage = 'Thêm tài khoản thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Thay đổi thông tin tài khoản thành công!';
                $this->user = $this->form->user;
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi. Vui lòng liên hệ lại với chúng tôi!';
        }
    }

    public function saveAndExit()
    {
        $this->save();
        if (!$this->errorMessage) {
            $this->redirect('/users');
        }
    }

    public function render()
    {
        return view(
            'livewire.security.user-management.action-user'
        );
    }
}
