<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public User $user;

    #[Validate('required', message: 'Vui lòng nhập tài khoản mới.')]
    #[Validate('min:3', message: 'Tài khoản phải có ít nhất 3 kí tự.')]
    public $username = '';
    
    #[Validate('required', message: 'Vui lòng nhập mật khẩu.')]
    #[Validate('min:6', message: 'Mật khẩu phải có ít nhất 6 kí tự.')]
    public $password = '';
    public $clinic_id = '';
    public $employee_id = '';
    public $date_permission = '';
    public $note = '';
    public $active = true;
    public $last_update_name = '';

    public function store()
    {
        User::create([
            'username' => $this->username,
            'clinic_id' => $this->clinic_id,
            'employee_id' => $this->employee_id,
            'password' => $this->password,
            'active' => $this->active,
            'note' => $this->note,
            'date_permission' => $this->date_permission,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['username', 'employee_id', 'password', 'active', 'note']);
    }

    public function setAttributes(User $user)
    {
        $this->user = $user;

        $this->username = $user->username;
        $this->clinic_id = $user->clinic_id;
        $this->employee_id = $user->employee_id;
        $this->password = $user->password;
        $this->active = $user->active;
        $this->note = $user->note;
        $this->date_permission = $user->date_permission;
        $this->last_update_name = $user->last_update_name;
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->user->update(
            $this->only(['username', 'password', 'note', 'active','employee_id','clinic_id', 'last_update_name','date_permission'])
        );
    }
}
